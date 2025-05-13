@extends('layouts.app')

@section('content')
    <div class="container fade-in">
        <h2 class="mb-4 text-center">Thanh Toán Đơn Hàng</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (empty($cart))
            <div class="alert alert-info">Giỏ hàng của bạn đang trống.</div>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
        @else
            <div class="row">
                <!-- Thông tin đơn hàng -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Thông Tin Đơn Hàng</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $subtotal = 0;
                                        @endphp
                                        @foreach ($cart as $id => $item)
                                            @php
                                                $itemTotal = $item['price'] * $item['quantity'];
                                                $subtotal += $itemTotal;
                                            @endphp
                                            <tr>
                                                <td>{{ $item['name'] }}</td>
                                                <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                                                <td>{{ $item['quantity'] }}</td>
                                                <td>{{ number_format($itemTotal, 0, ',', '.') }} VNĐ</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-end">Tổng cộng:</th>
                                            <th>{{ number_format($subtotal, 0, ',', '.') }} VNĐ</th>
                                        </tr>
                                        @if ($coupon)
                                            <tr>
                                                <th colspan="3" class="text-end">Mã giảm giá ({{ $coupon->code }}):</th>
                                                <th>-{{ number_format(($coupon->type == 'percentage' ? ($subtotal * $coupon->discount) / 100 : $coupon->discount), 0, ',', '.') }} VNĐ</th>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th colspan="3" class="text-end">Phí vận chuyển:</th>
                                            <th>Miễn phí</th>
                                        </tr>
                                        <tr class="table-success">
                                            <th colspan="3" class="text-end">Thành tiền:</th>
                                            <th>{{ number_format($total - ($coupon ? ($coupon->type == 'percentage' ? ($total * $coupon->discount) / 100 : $coupon->discount) : 0), 0, ',', '.') }} VNĐ</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!-- Form áp dụng mã giảm giá -->
                            <div class="mt-3">
                                @if ($coupon)
                                    <p>Đã áp dụng mã: <strong>{{ $coupon->code }}</strong> <a href="{{ route('checkout.remove-coupon') }}" class="text-danger">Xóa</a></p>
                                @else
                                    <form action="{{ route('checkout.apply-coupon') }}" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" name="coupon_code" class="form-control" placeholder="Nhập mã giảm giá">
                                            <button type="submit" class="btn btn-primary">Áp dụng</button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form thông tin khách hàng -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Thông Tin Khách Hàng</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('checkout.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="customer_name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ Auth::user()->name }}" required>
                                    @error('customer_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="customer_email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{ Auth::user()->email }}" required>
                                    @error('customer_email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="customer_phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required>
                                    @error('customer_phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="customer_address" class="form-label">Địa chỉ nhận hàng <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="customer_address" name="customer_address" rows="3" required>{{ old('customer_address') }}</textarea>
                                    @error('customer_address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phương thức thanh toán <span class="text-danger">*</span></label>
                                    <div class="payment-methods">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="payment_method" id="cash_on_delivery" value="cash_on_delivery" checked>
                                            <label class="form-check-label" for="cash_on_delivery">
                                                Thanh toán khi nhận hàng (COD)
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="payment_method" id="online_payment" value="online_payment">
                                            <label class="form-check-label" for="online_payment">
                                                Thanh toán trực tuyến (MoMo, ZaloPay, VNPay)
                                            </label>
                                        </div>
                                    </div>
                                    @error('payment_method')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-success btn-lg w-100">Xác Nhận Đặt Hàng</button>
                            </form>
                        </div>
                    </div>
                </div>
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
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    .form-control,
    .form-check-input {
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }
    .form-check-input:checked {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-success {
        background-color: #28a745;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-success:hover {
        background-color: #218838;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    .payment-methods .form-check {
        padding-left: 2rem;
    }
    .payment-methods .form-check-input {
        margin-left: -2rem;
    }
    .text-danger {
        font-size: 0.9rem;
    }
</style>
