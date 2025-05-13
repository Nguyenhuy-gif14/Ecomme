<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ReviewController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/orders', function () {
    return view('orders');
})->name('orders');

Route::get('/support', function () {
    return view('support');
})->name('support');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');

Route::get('/payment/vnpay/{orderId}', [PaymentController::class, 'vnpayPayment'])->name('payment.vnpay');
Route::get('/payment/vnpay/return', [PaymentController::class, 'vnpayReturn'])->name('payment.vnpay.return');

Route::get('/test-email', function () {
    $order = \App\Models\Order::first();
    if ($order) {
        \Illuminate\Support\Facades\Mail::to('sharknguyenhuy1123@gmail.com')->send(new \App\Mail\OrderConfirmation($order));
        return 'Email đã được gửi!';
    }
    return 'Không tìm thấy đơn hàng để gửi email.';
});


Route::get('/order-history', [OrderHistoryController::class, 'index'])->name('order.history');
Route::get('/order-history/{id}', [OrderHistoryController::class, 'show'])->name('order.detail');

Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('/products/search-suggestions', [ProductController::class, 'searchSuggestions'])->name('products.search-suggestions');

Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.apply-coupon');
Route::get('/checkout/remove-coupon', [CheckoutController::class, 'removeCoupon'])->name('checkout.remove-coupon');
