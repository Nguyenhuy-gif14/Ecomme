@extends('layouts.app')

@section('content')
    <!-- Slider -->
    <div id="carouselExample" class="carousel slide mb-4 fade-in" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($sliders as $index => $slider)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <a href="{{ $slider->link ?? '#' }}">
                        <img src="{{ asset('storage/' . $slider->image_path) }}" class="d-block w-100"
                            alt="{{ $slider->title }}" style="height: 450px; object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="text-white">{{ $slider->title }}</h5>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>

    <!-- Banner phụ -->
    <div class="row mb-5">
        <div class="col-md-6 mb-3 fade-in">
            <a href="/products?category=dien-thoai">
                <img src="{{ asset('images/banner-phone.jpg') }}" class="w-100 rounded"
                    style="height: 200px; object-fit: cover;" alt="Điện thoại">
            </a>
        </div>
        <div class="col-md-6 mb-3 fade-in">
            <a href="/products?category=laptop">
                <img src="{{ asset('images/banner-laptop.jpg') }}" class="w-100 rounded"
                    style="height: 200px; object-fit: cover;" alt="Laptop">
            </a>
        </div>
    </div>

    <!-- Sản phẩm nổi bật -->
    <div class="mb-5 fade-in">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Sản phẩm nổi bật</h2>
            <a href="/products" class="btn btn-outline-primary">Xem tất cả</a>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm border-0 product-card">
                        <div class="position-relative">
                            @if ($product->images->isNotEmpty())
                                <a href="/products/{{ $product->slug }}">
                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                        class="card-img-top product-image" alt="{{ $product->name }}"
                                        style="height: 200px; object-fit: contain; padding: 10px;">
                                </a>
                            @else
                                <a href="/products/{{ $product->slug }}">
                                    <img src="{{ asset('images/placeholder.jpg') }}" class="card-img-top product-image"
                                        alt="No image" style="height: 200px; object-fit: contain; padding: 10px;">
                                </a>
                            @endif
                            @if ($product->discount_price)
                                <span class="badge bg-danger position-absolute top-0 start-0 m-2">Giảm
                                    {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%</span>
                            @endif
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title"
                                style="font-size: 1.1rem; height: 50px; overflow: hidden; margin-bottom: 10px;">
                                <a href="/products/{{ $product->slug }}"
                                    class="text-dark text-decoration-none">{{ $product->name }}</a>
                            </h5>
                            <p class="card-text mb-2">
                                <strong
                                    class="text-danger">{{ number_format($product->discount_price ?? $product->price, 0, ',', '.') }}
                                    VNĐ</strong><br>
                                @if ($product->discount_price)
                                    <del class="text-muted small">{{ number_format($product->price, 0, ',', '.') }} VNĐ</del>
                                @endif
                            </p>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="/products/{{ $product->slug }}" class="btn btn-primary btn-sm">Xem chi tiết</a>
                                <form action="/cart/add/{{ $product->id }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success btn-sm"><i
                                            class="fas fa-cart-plus"></i> Thêm vào giỏ</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Sản phẩm theo danh mục -->
    @foreach ($categories as $category)
        @php
            $categoryProducts = \App\Models\Product::where('category_id', $category->id)->where('is_active', true)->limit(4)->get();
        @endphp
        @if ($categoryProducts->isNotEmpty())
            <div class="mb-5 fade-in">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="mb-0">{{ $category->name }}</h2>
                    <a href="/products?category={{ $category->slug }}" class="btn btn-outline-primary">Xem tất cả</a>
                </div>
                <div class="row">
                    @foreach ($categoryProducts as $product)
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="card h-100 shadow-sm border-0 product-card">
                                <div class="position-relative">
                                    @if ($product->images->isNotEmpty())
                                        <a href="/products/{{ $product->slug }}">
                                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                                class="card-img-top product-image" alt="{{ $product->name }}"
                                                style="height: 200px; object-fit: contain; padding: 10px;">
                                        </a>
                                    @else
                                        <a href="/products/{{ $product->slug }}">
                                            <img src="{{ asset('images/placeholder.jpg') }}" class="card-img-top product-image"
                                                alt="No image" style="height: 200px; object-fit: contain; padding: 10px;">
                                        </a>
                                    @endif
                                    @if ($product->discount_price)
                                        <span class="badge bg-danger position-absolute top-0 start-0 m-2">Giảm
                                            {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%</span>
                                    @endif
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"
                                        style="font-size: 1.1rem; height: 50px; overflow: hidden; margin-bottom: 10px;">
                                        <a href="/products/{{ $product->slug }}"
                                            class="text-dark text-decoration-none">{{ $product->name }}</a>
                                    </h5>
                                    <p class="card-text mb-2">
                                        <strong
                                            class="text-danger">{{ number_format($product->discount_price ?? $product->price, 0, ',', '.') }}
                                            VNĐ</strong><br>
                                        @if ($product->discount_price)
                                            <del class="text-muted small">{{ number_format($product->price, 0, ',', '.') }} VNĐ</del>
                                        @endif
                                    </p>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="/products/{{ $product->slug }}" class="btn btn-primary btn-sm">Xem chi tiết</a>
                                        <form action="/cart/add/{{ $product->id }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success btn-sm"><i
                                                    class="fas fa-cart-plus"></i> Thêm vào giỏ</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach

    <!-- Banner khuyến mãi -->
    <div class="row mb-5 fade-in">
        <div class="col-12">
            <a href="/promotions">
                <img src="{{ asset('images/promo-banner.jpg') }}" class="w-100 rounded"
                    style="height: 200px; object-fit: cover;" alt="Khuyến mãi">
            </a>
        </div>
    </div>
@endsection

<style>
    .carousel-item img {
        transition: transform 0.5s ease;
    }

    .carousel-item.active img {
        transform: scale(1.02);
    }

    .product-card {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .product-image {
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 123, 255, 0.1);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .product-card:hover::before {
        opacity: 1;
    }
</style>
