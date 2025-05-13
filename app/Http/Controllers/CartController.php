<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

        public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Sản phẩm ' . $product->name . ' đã hết hàng!');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $newQuantity = $cart[$productId]['quantity'] + 1;
            if ($newQuantity > $product->stock) {
                return redirect()->back()->with('error', 'Số lượng sản phẩm ' . $product->name . ' trong kho không đủ! Chỉ còn ' . $product->stock . ' sản phẩm.');
            }
            $cart[$productId]['quantity'] = $newQuantity;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->discount_price ?? $product->price,
                'quantity' => 1,
                'image' => $product->images->first()->image_path ?? 'placeholder.jpg',
            ];
        }

    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
}

        public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Xóa sản phẩm khỏi giỏ hàng thành công!');
        }

        return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
    }

    public function update(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity');

        if (isset($cart[$productId]) && $quantity > 0) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Cập nhật số lượng thành công!');
        }

        return redirect()->back()->with('error', 'Cập nhật số lượng thất bại!');
    }
}
