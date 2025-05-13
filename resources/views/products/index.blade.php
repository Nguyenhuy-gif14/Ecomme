@extends('layouts.app')

@section('content')
    <div class="container fade-in">
        <h2 class="mb-4 text-center">Danh Sách Sản Phẩm</h2>

        <!-- Tìm kiếm và lọc -->
        <div class="row mb-4 align-items-end g-3">
            <div class="col-md-6">
                <form action="{{ route('products.index') }}" method="GET">
                    <label for="search" class="form-label">Tìm kiếm sản phẩm</label>
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Nhập tên sản phẩm..."
                            value="{{ request('search') }}" autocomplete="off">
                        <button type="submit" class="btn btn-primary">Tìm</button>
                    </div>
                    <div id="search-suggestions" class="list-group position-absolute"
                        style="z-index: 1000; width: 100%; display: none;"></div>
                </form>
            </div>
            <div class="col-md-2">
                <label for="price_min" class="form-label">Giá từ</label>
                <input type="number" name="price_min" id="price_min" class="form-control" value="{{ request('price_min') }}"
                    placeholder="0">
            </div>
            <div class="col-md-2">
                <label for="price_max" class="form-label">Đến</label>
                <input type="number" name="price_max" id="price_max" class="form-control" value="{{ request('price_max') }}"
                    placeholder="100000000">
            </div>
            <div class="col-md-2">
                <label for="brand" class="form-label">Thương hiệu</label>
                <select name="brand" id="brand" class="form-select">
                    <option value="">Tất cả</option>
                    @foreach(['Apple', 'Samsung', 'Xiaomi', 'Sony', 'LG', 'Nokia', 'Huawei', 'Oppo', 'Vivo'] as $b)
                        <option value="{{ $b }}" {{ request('brand') == $b ? 'selected' : '' }}>{{ $b }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Nút lọc -->
        <div class="row mb-4">
            <div class="col text-end">
                <form action="{{ route('products.index') }}" method="GET">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="price_min" value="{{ request('price_min') }}">
                    <input type="hidden" name="price_max" value="{{ request('price_max') }}">
                    <input type="hidden" name="brand" value="{{ request('brand') }}">
                    <button type="submit" class="btn btn-success px-4">Lọc</button>
                </form>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">

                        @if ($product->images->count() > 0)
                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}"
                                class="card-img-top img-fluid" style="height: 220px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" alt="Không có ảnh" class="card-img-top img-fluid"
                                style="height: 220px; object-fit: cover;">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-danger fw-bold">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                            <p class="card-text">Đánh giá: {{ number_format($product->averageRating(), 1) }}/5</p>
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary mt-auto">Xem chi
                                tiết</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">Không tìm thấy sản phẩm nào.</p>
                </div>
            @endforelse
        </div>

        <!-- Phân trang -->
        <div class="d-flex justify-content-center">
            {{ $products->appends(request()->query())->links() }}
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

    .card-img-top {
        object-fit: cover;
    }

    .list-group-item {
        cursor: pointer;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
    }

    #search-suggestions {
        max-height: 250px;
        overflow-y: auto;
    }
</style>

<script>
    document.getElementById('search').addEventListener('input', function () {
        let query = this.value;
        if (query.length < 2) {
            document.getElementById('search-suggestions').style.display = 'none';
            return;
        }

        fetch(`/products/search-suggestions?query=${query}`)
            .then(response => response.json())
            .then(data => {
                let suggestionsDiv = document.getElementById('search-suggestions');
                suggestionsDiv.innerHTML = '';
                if (data.length > 0) {
                    data.forEach(product => {
                        let item = document.createElement('a');
                        item.classList.add('list-group-item', 'list-group-item-action');
                        item.href = `/products/${product.slug}`;
                        item.textContent = product.name;
                        suggestionsDiv.appendChild(item);
                    });
                    suggestionsDiv.style.display = 'block';
                } else {
                    suggestionsDiv.style.display = 'none';
                }
            });
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('#search') && !e.target.closest('#search-suggestions')) {
            document.getElementById('search-suggestions').style.display = 'none';
        }
    });
</script>
