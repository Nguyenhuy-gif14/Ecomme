<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function vnpayPayment(Request $request, $orderId)
    {
        Log::info('Bắt đầu xử lý thanh toán VNPay cho đơn hàng #' . $orderId);

        $order = Order::findOrFail($orderId);
        $vnp_TmnCode = config('vnpay.vnp_TmnCode');
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $vnp_Url = config('vnpay.vnp_Url');
        $vnp_Returnurl = config('vnpay.vnp_ReturnUrl');

        $vnp_TxnRef = $order->id; // Mã đơn hàng
        $vnp_OrderInfo = 'Thanh toán đơn hàng #' . $order->id;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $order->total_amount * 100; // Số tiền (VNĐ * 100)
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $request->ip();
        $vnp_CreateDate = date('YmdHis');
        $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes'));

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => $vnp_CreateDate,
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate,
        ];

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        $vnpSecureHash = hash_hmac("sha512", $hashdata, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

        Log::info('Chuyển hướng đến URL VNPay: ' . $vnp_Url);
        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        Log::info('Nhận kết quả trả về từ VNPay: ' . json_encode($request->all()));

        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $vnp_SecureHash = $request->vnp_SecureHash;
        $inputData = $request->except('vnp_SecureHash');

        ksort($inputData);
        $hashData = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac("sha512", $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($request->vnp_ResponseCode == '00') {
                $order = Order::findOrFail($request->vnp_TxnRef);
                $order->status = 'processing';
                $order->save();
                return redirect('/')->with('success', 'Thanh toán thành công! Đơn hàng của bạn đang được xử lý.');
            } else {
                return redirect('/')->with('error', 'Thanh toán thất bại. Vui lòng thử lại.');
            }
        } else {
            return redirect('/')->with('error', 'Chữ ký không hợp lệ. Thanh toán thất bại.');
        }
    }
}
