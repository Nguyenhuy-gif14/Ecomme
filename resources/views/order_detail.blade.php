@extends('layouts.app')

@section('content')
    <div class="container fade-in">
        <h2 class="mb-4 text-center">Chi Tiết Đơn Hàng #{{ $order->id }}</h2>
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Thông Tin Khách Hàng</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Họ và tên:</strong> {{ $order->customer_name }}</p>
                        <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                        <p><strong>Số điện thoại:</strong> {{ $order->customer_phone }}</p>
                        <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>
                        <p><strong>Phương thức thanh toán:</strong>
                            {{ $order->payment_method == 'cash_on_delivery' ? 'Thanh toán khi nhận hàng' : 'Thanh toán trực tuyến' }}
                        </p>
                        <p><strong>Trạng thái:</strong>
                            <span
                                class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'processing' ? 'info' : ($order->status == 'shipped' ? 'primary' : ($order->status == 'delivered' ? 'success' : 'danger'))) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Chi Tiết Đơn Hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
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
                                        <th>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('back-button')
    <div class="back-button fade-in">
        <a href="{{ route('order.history') }}"><i class="fas fa-arrow-left me-1"></i> Quay lại</a>
    </div>
@endsection

<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #007bff;
        border-bottom: none;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }
</style>
