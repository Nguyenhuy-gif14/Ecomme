@extends('layouts.app')

@section('content')
    <div class="container fade-in">
        <h2 class="mb-4 text-center">Lịch Sử Đơn Hàng</h2>
        @if ($orders->isEmpty())
            <div class="alert alert-info">Bạn chưa có đơn hàng nào.</div>
            <a href="/products" class="btn btn-primary">Mua sắm ngay</a>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Phương thức thanh toán</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>
                                <td>{{ $order->payment_method == 'cash_on_delivery' ? 'Thanh toán khi nhận hàng' : 'Thanh toán trực tuyến' }}
                                </td>
                                <td>
                                    <span
                                        class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'processing' ? 'info' : ($order->status == 'shipped' ? 'primary' : ($order->status == 'delivered' ? 'success' : 'danger'))) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('order.detail', $order->id) }}" class="btn btn-primary btn-sm">Xem chi
                                        tiết</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection

@section('back-button')
    <div class="back-button fade-in">
        <a href="javascript:history.back()"><i class="fas fa-arrow-left me-1"></i> Quay lại</a>
    </div>
@endsection

<style>
    .table th,
    .table td {
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .btn-primary {
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }
</style>
