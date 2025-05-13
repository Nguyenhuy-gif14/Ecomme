<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Xác nhận đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .content {
            padding: 20px;
        }

        .footer {
            text-align: center;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 0 0 8px 8px;
            font-size: 0.9em;
            color: #777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .total {
            font-weight: bold;
            font-size: 1.1em;
            color: #dc3545;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Xác Nhận Đơn Hàng #{{ $order->id }}</h2>
        </div>
        <div class="content">
            <p>Xin chào <strong>{{ $order->customer_name }}</strong>,</p>
            <p>Cảm ơn bạn đã đặt hàng tại <strong>Thanh Huy Mobile</strong>! Dưới đây là chi tiết đơn hàng của bạn:</p>

            <h3>Thông tin khách hàng</h3>
            <p><strong>Họ và tên:</strong> {{ $order->customer_name }}</p>
            <p><strong>Email:</strong> {{ $order->customer_email }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order->customer_phone }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>

            <h3>Chi tiết đơn hàng</h3>
            <table>
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->subtotal, 0, ',', '.') }} VNĐ</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Tổng cộng:</th>
                        <th class="total">{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</th>
                    </tr>
                </tfoot>
            </table>

            <p><strong>Phương thức thanh toán:</strong>
                {{ $order->payment_method == 'cash_on_delivery' ? 'Thanh toán khi nhận hàng' : 'Thanh toán trực tuyến' }}
            </p>
            <p><strong>Trạng thái:</strong> {{ ucfirst($order->status) }}</p>

            <p>Bạn có thể xem chi tiết đơn hàng tại đây:</p>
            <a href="{{ route('order.detail', $order->id) }}" class="button">Xem đơn hàng</a>
        </div>
        <div class="footer">
            <p>Trân trọng,<br>Thanh Huy Mobile</p>
            <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ: <a
                    href="sharknguyenhuy1123@gamil.com">support@thanhhuymobile.com</a></p>
        </div>
    </div>
</body>

</html>
