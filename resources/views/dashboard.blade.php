@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-center">Trang Quản Lý</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Chào mừng đến với Trang Quản Lý</h4>
                    </div>
                    <div class="card-body">
                        <p>Đây là trang quản lý của bạn. Bạn có thể xem thông tin tài khoản hoặc quản lý đơn hàng tại đây.
                        </p>
                        <a href="{{ route('order.history') }}" class="btn btn-primary">Xem lịch sử đơn hàng</a>
                    </div>
                </div>
            </div>
        </div>
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

    .btn-primary {
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
</style>
