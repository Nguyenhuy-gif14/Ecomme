@extends('layouts.app')

@section('content')
    <div class="container fade-in">
        <h2 class="mb-4">Đơn hàng của bạn</h2>
        <div class="alert alert-info">Trang đơn hàng đang được cập nhật.</div>
    </div>
@endsection

@section('back-button')
    <div class="back-button fade-in">
        <a href="javascript:history.back()"><i class="fas fa-arrow-left me-1"></i> Quay lại</a>
    </div>
@endsection
