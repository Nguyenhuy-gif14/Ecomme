@extends('layouts.app')

@section('back-button')
    <div class="back-button fade-in mb-3">
        <a href="javascript:history.back()" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Quay lại
        </a>
    </div>
@endsection

@section('content')
    <div class="container fade-in">
        <h2 class="mb-4 text-center">Tin Tức Mới Nhất</h2>

        {{-- Thông báo --}}
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-1"></i> Trang tin tức đang được cập nhật. Mời bạn quay lại sau!
        </div>


        <div class="row">
            @foreach($newsList as $news)
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $news->image) }}" class="card-img-top" alt="{{ $news->title }}"
                        style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $news->title }}</h5>
                        <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($news->content, 100) }}</p>
                        <a href="{{ route('news.show', $news->slug) }}" class="btn btn-sm btn-primary mt-2">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
@endsection

<style>
    .fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
