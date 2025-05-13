<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"content="Thanh Huy Mobile - Cửa hàng điện thoại, laptop, phụ kiện chính hãng với giá tốt nhất. Mua sắm online dễ dàng, giao hàng nhanh chóng.">
    <meta name="keywords" content="điện thoại, laptop, phụ kiện, Thanh Huy Mobile, mua sắm online">
    <meta name="author" content="Thanh Huy Mobile">
    <meta name="robots" content="index, follow">
    <title>@yield('title', 'Thanh Huy Mobile - Mua Sắm Online')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #3b82f6;
            --dark-color: #1a1a1a;
            --light-color: #f8f9fa;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --text-color: #333333;
            --text-light: #6b7280;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            color: var(--text-color);
            background-color: #ffffff;
            line-height: 1.6;
            overflow-x: hidden;
            position: relative;
        }

        /* Top Bar */
        .top-bar {
            background-color: var(--dark-color);
            color: white;
            font-size: 14px;
            padding: 8px 0;
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .top-bar:hover {
            background-color: #2c2c2c;
        }

        .top-bar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .top-bar-left, .top-bar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-bar a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .top-bar a:hover {
            color: var(--accent-color);
        }

        .top-bar i {
            font-size: 12px;
        }

        /* Navbar */
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 10px 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            height: 50px;
            transition: transform 0.3s ease;
        }

        .navbar-brand img:hover {
            transform: scale(1.05);
        }

        .navbar-toggler {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--dark-color);
            cursor: pointer;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            color: var(--dark-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .nav-link i {
            font-size: 16px;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Search Bar */
        .search-container {
            flex-grow: 1;
            max-width: 600px;
            margin: 0 30px;
            position: relative;
        }

        .search-form {
            display: flex;
            width: 100%;
        }

        .search-input {
            flex-grow: 1;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px 0 0 4px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
        }

        .search-button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0 20px;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-button:hover {
            background-color: var(--secondary-color);
        }

        /* Cart Icon */
        .cart-icon {
            position: relative;
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--danger-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: bold;
            animation: pulse 2s infinite;
        }

        /* Sidebar */
        .sidebar-toggle {
            position: fixed;
            top: 100px;
            left: 20px;
            z-index: 999;
            background-color: var(--primary-color);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background-color: var(--secondary-color);
            transform: scale(1.1);
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100vh;
            background-color: white;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 998;
            padding-top: 120px;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            overflow-y: auto;
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .sidebar-header {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 10px;
        }

        .sidebar-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-item {
            border-bottom: 1px solid #f0f0f0;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar-link i {
            margin-right: 10px;
            color: var(--primary-color);
            font-size: 16px;
        }

        .sidebar-link:hover {
            background-color: #f5f5f5;
            color: var(--primary-color);
            padding-left: 25px;
        }

        /* Main Content */
        .main-content {
            min-height: calc(100vh - 300px);
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Floating Buttons */
        .floating-buttons {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            z-index: 997;
        }

        .floating-button {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .floating-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3));
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .floating-button:hover {
            transform: translateY(-5px);
        }

        .floating-button:hover::before {
            transform: translateX(100%);
        }

        .floating-button.zalo {
            background-color: #00c4b4;
        }

        .floating-button.phone {
            background-color: var(--success-color);
        }

        .floating-button.facebook {
            background-color: #4267b2;
        }

        .floating-button.messenger {
            background: linear-gradient(135deg, #006aff, #00c6ff);
        }

        .floating-button.tooltip {
            position: absolute;
            right: 60px;
            background-color: var(--dark-color);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .floating-button:hover .tooltip {
            opacity: 1;
        }

        /* Footer */
        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 50px 0 20px;
        }

        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .footer-column h5 {
            font-size: 18px;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-column h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background-color: var(--primary-color);
        }

        .footer-links {
            list-style: none;
        }

        .footer-link {
            margin-bottom: 10px;
        }

        .footer-link a {
            color: #b0b0b0;
            text-decoration: none;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-link a:hover {
            color: white;
        }

        .footer-link i {
            font-size: 12px;
            color: var(--primary-color);
        }

        .footer-about p {
            color: #b0b0b0;
            margin-bottom: 15px;
        }

        .footer-contact p {
            color: #b0b0b0;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-contact i {
            color: var(--primary-color);
            width: 16px;
            text-align: center;
        }

        .payment-methods {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }

        .payment-method {
            width: 50px;
            height: 30px;
            object-fit: contain;
            background-color: white;
            padding: 3px;
            border-radius: 4px;
            transition: transform 0.3s ease;
        }

        .payment-method:hover {
            transform: scale(1.1);
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-link {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #2c2c2c;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            transform: translateY(-3px);
        }

        .social-link.facebook:hover {
            background-color: #4267b2;
        }

        .social-link.youtube:hover {
            background-color: #ff0000;
        }

        .social-link.instagram:hover {
            background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
        }

        .social-link.twitter:hover {
            background-color: #1da1f2;
        }

        .newsletter-form {
            margin-top: 20px;
        }

        .newsletter-input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .newsletter-button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .newsletter-button:hover {
            background-color: var(--secondary-color);
        }

        .footer-bottom {
            background-color: #111;
            padding: 15px 0;
            margin-top: 30px;
        }

        .footer-bottom-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .copyright {
            color: #b0b0b0;
            font-size: 14px;
        }

        .bct-logo img {
            height: 40px;
            filter: grayscale(100%);
            transition: filter 0.3s ease;
        }

        .bct-logo:hover img {
            filter: grayscale(0%);
        }

        /* Animations */
        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
            }
            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(239, 68, 68, 0);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        /* Breadcrumb */
        .breadcrumb {
            padding: 15px 0;
            background-color: #f9f9f9;
            margin-bottom: 30px;
        }

        .breadcrumb-list {
            display: flex;
            list-style: none;
            flex-wrap: wrap;
        }

        .breadcrumb-item {
            font-size: 14px;
            color: var(--text-light);
        }

        .breadcrumb-item:not(:last-child)::after {
            content: '/';
            margin: 0 8px;
            color: #ccc;
        }

        .breadcrumb-item a {
            color: var(--text-light);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb-item a:hover {
            color: var(--primary-color);
        }

        .breadcrumb-item.active {
            color: var(--primary-color);
            font-weight: 500;
        }

        /* Alerts */
        .alert {
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: fadeIn 0.5s ease-out;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border-left: 4px solid var(--success-color);
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #b91c1c;
            border-left: 4px solid var(--danger-color);
        }

        .alert-warning {
            background-color: #fef3c7;
            color: #92400e;
            border-left: 4px solid var(--warning-color);
        }

        .alert-close {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: inherit;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        .alert-close:hover {
            opacity: 1;
        }

        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            left: 30px;
            width: 50px;
            height: 50px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 997;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .navbar-container {
                flex-wrap: wrap;
            }

            .search-container {
                order: 3;
                width: 100%;
                margin: 15px 0 0;
            }

            .navbar-menu {
                display: none;
            }

            .navbar-toggler {
                display: block;
            }

            .sidebar-toggle {
                top: 90px;
                left: 10px;
            }

            .floating-buttons {
                bottom: 20px;
                right: 20px;
            }
        }

        @media (max-width: 768px) {
            .top-bar-container {
                flex-direction: column;
                gap: 8px;
                text-align: center;
            }

            .footer-container {
                grid-template-columns: 1fr;
            }

            .footer-bottom-container {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="top-bar-container">
            <div class="top-bar-left">
                <a href="tel:19001977"><i class="fas fa-phone-alt"></i> Hotline: 1900 1977</a>
                <a href="#"><i class="fas fa-truck"></i> Miễn phí vận chuyển</a>
                <a href="#"><i class="fas fa-map-marker-alt"></i> Hệ thống cửa hàng</a>
            </div>
            <div class="top-bar-right">
                @guest
                    <a href="/login"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a>
                    <a href="/register"><i class="fas fa-user-plus"></i> Đăng ký</a>
                @else
                    <span>Xin chào, {{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Đăng xuất
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <button class="navbar-toggler">
                <i class="fas fa-bars"></i>
            </button>

            <a href="/" class="navbar-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Thanh Huy Mobile">
            </a>

            <div class="search-container">
                <form class="search-form" action="/products" method="GET">
                    <input type="search" class="search-input" name="search" placeholder="Tìm kiếm sản phẩm...">
                    <button type="submit" class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <ul class="navbar-menu">
                <li class="nav-item">
                    <a href="/" class="nav-link"><i class="fas fa-home"></i> Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a href="/promotions" class="nav-link"><i class="fas fa-tags"></i> Khuyến mãi</a>
                </li>
                <li class="nav-item">
                    <a href="/news" class="nav-link"><i class="fas fa-newspaper"></i> Tin tức</a>
                </li>
                <li class="nav-item">
                    <a href="/orders" class="nav-link"><i class="fas fa-box"></i> Đơn hàng</a>
                </li>
                <li class="nav-item">
                    <a href="/support" class="nav-link"><i class="fas fa-headset"></i> Hỗ trợ</a>
                </li>
                <li class="nav-item">
                    <a href="/cart" class="nav-link cart-icon">
                        <i class="fas fa-shopping-cart"></i> Giỏ hàng
                        <span class="cart-badge">{{ session('cart') ? count(session('cart')) : 0 }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('order.history') }}">Lịch sử đơn hàng</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar Toggle -->
    <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3 class="sidebar-title">
                <i class="fas fa-list"></i> Danh mục sản phẩm
            </h3>
        </div>
        <ul class="sidebar-menu">
            @foreach ($categories as $category)
                <li class="sidebar-item">
                    <a href="/products?category={{ $category->slug }}" class="sidebar-link">
                        <i class="fas fa-mobile-alt"></i> {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </aside>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <ul class="breadcrumb-list">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                @yield('breadcrumb')
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Alerts -->
            @if (session('success'))
                <div class="alert alert-success fade-in">
                    <div>{{ session('success') }}</div>
                    <button class="alert-close">&times;</button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger fade-in">
                    <div>{{ session('error') }}</div>
                    <button class="alert-close">&times;</button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column footer-about">
                <h5>Thanh Huy Mobile</h5>
                <p>Chuyên cung cấp điện thoại, laptop và phụ kiện chính hãng với giá tốt nhất, cam kết chất lượng, bảo hành uy tín và nhiều ưu đãi hấp dẫn.</p>
                <div class="social-links">
                    <a href="#" class="social-link facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link youtube"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="social-link instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link twitter"><i class="fab fa-twitter"></i></a>
                </div>
            </div>

            <div class="footer-column">
                <h5>Danh mục</h5>
                <ul class="footer-links">
                    <li class="footer-link"><a href="/products?category=dien-thoai"><i class="fas fa-chevron-right"></i> Điện thoại</a></li>
                    <li class="footer-link"><a href="/products?category=laptop"><i class="fas fa-chevron-right"></i> Laptop</a></li>
                    <li class="footer-link"><a href="/products?category=phu-kien"><i class="fas fa-chevron-right"></i> Phụ kiện</a></li>
                    <li class="footer-link"><a href="/promotions"><i class="fas fa-chevron-right"></i> Khuyến mãi</a></li>
                    <li class="footer-link"><a href="/news"><i class="fas fa-chevron-right"></i> Tin tức</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h5>Hỗ trợ</h5>
                <ul class="footer-links">
                    <li class="footer-link"><a href="/contact"><i class="fas fa-chevron-right"></i> Liên hệ</a></li>
                    <li class="footer-link"><a href="/policy"><i class="fas fa-chevron-right"></i> Chính sách bảo hành</a></li>
                    <li class="footer-link"><a href="/faq"><i class="fas fa-chevron-right"></i> Câu hỏi thường gặp</a></li>
                    <li class="footer-link"><a href="/shipping"><i class="fas fa-chevron-right"></i> Chính sách vận chuyển</a></li>
                    <li class="footer-link"><a href="/return"><i class="fas fa-chevron-right"></i> Chính sách đổi trả</a></li>
                </ul>
            </div>

            <div class="footer-column footer-contact">
                <h5>Liên hệ</h5>
                <p><i class="fas fa-map-marker-alt"></i> ĐT743/1374 Đ. Chiêu Liêu, An Phú, Dĩ An, Bình Dương</p>
                <p><i class="fas fa-phone-alt"></i> 08 555 009 39</p>
                <p><i class="fas fa-envelope"></i> thanhhuymobile.infocontract@gmail.com</p>

                <h5 style="margin-top: 20px;">Thanh toán miễn phí</h5>
                <div class="payment-methods">
                    <img src="{{ asset('images/visa.png') }}" alt="Visa" class="payment-method">
                    <img src="{{ asset('images/mastercard.png') }}" alt="MasterCard" class="payment-method">
                    <img src="{{ asset('images/jcb.png') }}" alt="JCB" class="payment-method">
                    <img src="{{ asset('images/zalopay.png') }}" alt="ZaloPay" class="payment-method">
                    <img src="{{ asset('images/momo.png') }}" alt="MoMo" class="payment-method">
                    <img src="{{ asset('images/applepay.png') }}" alt="Apple Pay" class="payment-method">
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-container">
                <div class="copyright">
                    &copy; 2025 Thanh Huy Mobile. All rights reserved.
                </div>
                <div class="bct-logo">
                    <a href="http://online.gov.vn" target="_blank">
                        <img src="{{ asset('images/bct.png') }}" alt="Bộ Công Thương">
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating Buttons -->
    <div class="floating-buttons">
        <a href="https://zalo.me/0123456789" class="floating-button zalo" target="_blank">
            <i class="fab fa-zalo"></i>
            <span class="tooltip">Chat Zalo</span>
        </a>
        <a href="tel:0123456789" class="floating-button phone">
            <i class="fas fa-phone-alt"></i>
            <span class="tooltip">Gọi ngay</span>
        </a>
        <a href="https://m.me/thanhhuymobile" class="floating-button messenger" target="_blank">
            <i class="fab fa-facebook-messenger"></i>
            <span class="tooltip">Messenger</span>
        </a>
    </div>

    <!-- Back to Top Button -->
    <div class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </div>

    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('open');
        }

        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            // Back to Top Button
            const backToTop = document.getElementById('backToTop');
            if (window.scrollY > 300) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        });

        // Back to Top
        document.getElementById('backToTop').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Close Alert
        document.querySelectorAll('.alert-close').forEach(button => {
            button.addEventListener('click', function() {
                this.parentElement.style.opacity = '0';
                setTimeout(() => {
                    this.parentElement.remove();
                }, 300);
            });
        });

        // Mobile Menu Toggle
        document.querySelector('.navbar-toggler').addEventListener('click', function() {
            document.querySelector('.navbar-menu').classList.toggle('show');
        });
    </script>
</body>

</html>
