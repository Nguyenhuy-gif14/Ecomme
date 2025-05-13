<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $coupon = session()->get('coupon');

        return view('checkout', compact('cart', 'total', 'coupon'));
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
        ]);

        $coupon = Coupon::where('code', $request->coupon_code)
            ->where('is_active', true)
            ->where('expires_at', '>=', now())
            ->first();

        if (!$coupon) {
            return redirect()->back()->with('error', 'Mã giảm giá không hợp lệ hoặc đã hết hạn.');
        }

        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        if ($coupon->min_order_amount && $total < $coupon->min_order_amount) {
            return redirect()->back()->with('error', 'Đơn hàng của bạn chưa đạt giá trị tối thiểu để áp dụng mã giảm giá.');
        }

        session()->put('coupon', $coupon);

        return redirect()->back()->with('success', 'Áp dụng mã giảm giá thành công!');
    }

    public function removeCoupon()
    {
        session()->forget('coupon');
        return redirect()->back()->with('success', 'Đã xóa mã giảm giá.');
    }

    public function store(Request $request)
    {
        Log::info('Bắt đầu xử lý thanh toán');

        // Debug dữ liệu gửi từ form
        Log::info('Dữ liệu gửi từ form: ' . json_encode($request->all()));

        // Kiểm tra giá trị payment_method trước validation
        Log::info('Phương thức thanh toán (trước validation): ' . ($request->payment_method ?? 'Không có giá trị'));

        // Kiểm tra validation
        try {
            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
                'customer_email' => 'required|email|max:255',
                'customer_phone' => 'required|string|max:15|regex:/^[0-9]{10,15}$/',
                'customer_address' => 'required|string',
                'payment_method' => 'required|in:cash_on_delivery,online_payment',
            ]);
            Log::info('Validation thành công: ' . json_encode($validated));
        } catch (\Exception $e) {
            Log::error('Validation thất bại: ' . $e->getMessage());
            throw $e;
        }

        // Debug giá trị payment_method sau validation
        Log::info('Phương thức thanh toán: ' . $request->payment_method);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        // Kiểm tra tồn kho
        foreach ($cart as $productId => $item) {
            $product = Product::findOrFail($productId);
            if ($product->stock < $item['quantity']) {
                return redirect('/cart')->with('error', 'Sản phẩm ' . $product->name . ' không đủ số lượng trong kho! Chỉ còn ' . $product->stock . ' sản phẩm.');
            }
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Áp dụng mã giảm giá
        $coupon = session()->get('coupon');
        $discount = 0;
        if ($coupon) {
            if ($coupon->type == 'percentage') {
                $discount = ($total * $coupon->discount) / 100;
            } else {
                $discount = $coupon->discount;
            }
            $total -= $discount;
        }

        // Tạo đơn hàng
        $order = Order::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'total_amount' => $total,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'coupon_id' => $coupon ? $coupon->id : null,
            'discount_amount' => $discount,
        ]);

        // Tạo chi tiết đơn hàng và cập nhật tồn kho
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);

            // Giảm số lượng tồn kho
            $product = Product::find($productId);
            $product->stock -= $item['quantity'];
            $product->save();
        }

        // Gửi email xác nhận
        Log::info('Bắt đầu gửi email xác nhận cho đơn hàng #' . $order->id);
        try {
            Mail::to($order->customer_email)->send(new OrderConfirmation($order));
            Log::info('Gửi email xác nhận thành công cho đơn hàng #' . $order->id);
        } catch (\Exception $e) {
            Log::error('Gửi email xác nhận thất bại cho đơn hàng #' . $order->id . ': ' . $e->getMessage());
            return redirect('/')->with('success', 'Đặt hàng thành công! Tuy nhiên, không thể gửi email xác nhận. Vui lòng kiểm tra lại thông tin.');
        }

        // Xóa giỏ hàng và mã giảm giá sau khi đặt hàng
        session()->forget(['cart', 'coupon']);

        // Chuyển hướng đến VNPay nếu chọn thanh toán trực tuyến
        if ($request->payment_method == 'online_payment') {
            Log::info('Chuyển hướng đến VNPay cho đơn hàng #' . $order->id);
            return redirect()->route('payment.vnpay', $order->id);
        }

        return redirect('/')->with('success', 'Đặt hàng thành công! Chúng tôi đã gửi email xác nhận đến bạn.');
    }
}
