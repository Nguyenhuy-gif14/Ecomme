@extends('layouts.app')

@section('content')
    <div class="container fade-in">
        <h2 class="mb-4 text-center">Chi Tiết Sản Phẩm</h2>
        <div class="row">
            <div class="col-md-6 mb-4">

                <img src="{{ $product->images->count() > 0
    ? asset('storage/' . $product->images->first()->image_path)
    : asset('images/no-image.png') }}" alt="{{ $product->name }}" class="img-fluid card-img-top" />

            </div>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->name }}</h4>
                        <p class="card-text text-danger fs-4">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>Tồn kho:</strong> {{ $product->stock }}</p>
                        <p class="card-text"><strong>Đánh giá trung bình:</strong>
                            {{ number_format($product->averageRating(), 1) }}/5 ({{ $product->reviews->count() }} đánh giá)
                        </p>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form đánh giá -->
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Đánh Giá Sản Phẩm</h4>
            </div>
            <div class="card-body">
                @if (Auth::check())
                    @if ($product->reviews()->where('user_id', Auth::id())->exists())
                        <div class="alert alert-info">Bạn đã đánh giá sản phẩm này.</div>
                    @else
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="mb-3">
                                <label for="rating" class="form-label">Điểm đánh giá <span class="text-danger">*</span></label>
                                <select name="rating" id="rating" class="form-control" required>
                                    <option value="1">1 sao</option>
                                    <option value="2">2 sao</option>
                                    <option value="3">3 sao</option>
                                    <option value="4">4 sao</option>
                                    <option value="5">5 sao</option>
                                </select>
                                @error('rating')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Nhận xét</label>
                                <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
                                @error('comment')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success">Gửi đánh giá</button>
                        </form>
                    @endif
                @else
                    <div class="alert alert-warning">Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để đánh giá sản phẩm.
                    </div>
                @endif
            </div>
        </div>

        <!-- Hiển thị danh sách đánh giá -->
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Nhận Xét Từ Người Dùng</h4>
            </div>
            <div class="card-body">
                @if ($product->reviews->isEmpty())
                    <p>Chưa có đánh giá nào cho sản phẩm này.</p>
                @else
                    @foreach ($product->reviews as $review)
                        <div class="review mb-3 p-3 border rounded">
                            <p><strong>{{ $review->user->name }}</strong> ({{ $review->rating }}/5 sao) -
                                {{ $review->created_at->format('d/m/Y H:i') }}</p>
                            <p>{{ $review->comment ?: 'Không có nhận xét.' }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection

@section('back-button')
    <div class="back-button fade-in">
        <a href="{{ route('products.index') }}"><i class="fas fa-arrow-left me-1"></i> Quay lại</a>
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

    .review {
        background-color: #f8f9fa;
    }

    .btn-success {
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background-color: #218838;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
</style>
