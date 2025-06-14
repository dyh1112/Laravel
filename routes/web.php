<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // ✅ 加這行
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EcpayController;

// 如果未登入，就導去登入頁；已登入就導去商品頁
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('products.index')
        : redirect()->route('login');
});

// 需要登入的功能
Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    // 顯示新增商品表單
    

// 表單送出，新增商品
    


    // 購物車
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // 結帳
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/ecpay/get-token', [EcpayController::class, 'getToken'])->name('ecpay.get-token');
    Route::post('/ecpay/get-token', [EcpayController::class, 'getToken'])->name('ecpay.get-token');
    Route::get('/pay', function () {
        return view('pay');
    })->name('pay.page');

    // routes/web.php
    
    


});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Breeze 登入、註冊、登出等路由
require __DIR__.'/auth.php';
