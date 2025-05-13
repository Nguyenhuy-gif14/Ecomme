@extends('layouts.app')

@section('content')
    <div class="container fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Giỏ hàng của bạn</h2>
            <a href="/products" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Tiếp tục mua sắm
            </a>
        </div>

        @if (empty($cart))
            <div class="empty-cart text-center py-5">
                <div class="empty-cart-icon mb-4">
                    <i class="fas fa-shopping-cart fa-4x text-muted"></i>
                </div>
                <h4 class="mb-3">Giỏ hàng của bạn đang trống</h4>
                <p class="text-muted mb-4">Hãy khám phá sản phẩm và thêm vào giỏ hàng</p>
                <a href="/products" class="btn btn-primary btn-lg">
                    <i class="fas fa-store-alt me-2"></i>Mua sắm ngay
                </a>
            </div>
        @else
            <div class="card shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 40%">Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $id => $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                                    class="img-thumbnail border-0"
                                                    style="width: 80px; height: 80px; object-fit: contain;">
                                            </div>
                                            <div>
                                                <h6 class="mb-1">{{ $item['name'] }}</h6>
                                                <small class="text-muted">SKU: {{ $id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="fw-bold">{{ number_format($item['price'], 0, ',', '.') }} VNĐ</span>
                                    </td>
                                    <td class="align-middle" style="width: 180px">
                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="quantity-form">
                                            @csrf
                                            <div class="input-group">
                                                <button type="button" class="btn btn-outline-secondary quantity-minus">-</button>
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                                    class="form-control text-center quantity-input">
                                                <button type="button" class="btn btn-outline-secondary quantity-plus">+</button>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="align-middle">
                                        <span
                                            class="fw-bold text-primary">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                            VNĐ</span>
                                    </td>
                                    <td class="align-middle text-end">
                                        <form action="{{ route('cart.remove', $id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')">
                                                <i class="fas fa-trash"></i> Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Mã giảm giá">
                                <button class="btn btn-secondary" type="button">Áp dụng</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tạm tính:</span>
                                <span
                                    class="fw-bold">{{ number_format(array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity']; }, $cart)), 0, ',', '.') }}
                                    VNĐ</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Phí vận chuyển:</span>
                                <span class="fw-bold">0 VNĐ</span>
                            </div>
                            <div class="d-flex justify-content-between border-top pt-3">
                                <span class="h5">Tổng cộng:</span>
                                <span
                                    class="h4 text-primary fw-bold">{{ number_format(array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity']; }, $cart)), 0, ',', '.') }}
                                    VNĐ</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="/products" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Tiếp tục mua sắm
                </a>
                <a href="{{ route('checkout') }}" class="btn btn-success btn-lg px-4">
                    <i class="fas fa-credit-card me-2"></i>Thanh toán
                </a>
            </div>
        @endif
    </div>
@endsection

@section('back-button')
    <div class="back-button fade-in">
        <a href="javascript:history.back()" class="text-decoration-none">
            <i class="fas fa-arrow-left me-2"></i> Quay lại
        </a>
    </div>
@endsection

@push('styles')
    <style>
        .empty-cart {
            max-width: 500px;
            margin: 0 auto;
        }

        .empty-cart-icon {
            opacity: 0.7;
        }

        .quantity-form .input-group {
            width: 130px;
        }

        .quantity-input {
            -moz-appearance: textfield;
        }

        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .quantity-plus,
        .quantity-minus {
            width: 40px;
        }

        .table th {
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .card {
            border-radius: 12px;
            overflow: hidden;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .back-button {
            position: fixed;
            bottom: 30px;
            left: 30px;
            z-index: 99;
        }

        .back-button a {
            background-color: #fff;
            padding: 10px 15px;
            border-radius: 50px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            color: #333;
            transition: all 0.3s ease;
        }

        .back-button a:hover {
            background-color: #f8f9fa;
            transform: translateX(-5px);
            text-decoration: none;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function () {
            // Quantity buttons functionality
            $('.quantity-plus').click(function () {
                let input = $(this).siblings('.quantity-input');
                input.val(parseInt(input.val()) + 1);
                $(this).closest('form').submit();
            });

            $('.quantity-minus').click(function () {
                let input = $(this).siblings('.quantity-input');
                if (parseInt(input.val()) > 1) {
                    input.val(parseInt(input.val()) - 1);
                    $(this).closest('form').submit();
                }
            });
        });
    </script>
@endpush
