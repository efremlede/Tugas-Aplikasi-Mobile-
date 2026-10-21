<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes - Toko Semen Jaya
|--------------------------------------------------------------------------
*/

// Redirect URL utama ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route Dashboard Utama
Route::get('/dashboard', function () {
    return view('kasir.dashboard');
})->middleware(['auth'])->name('dashboard');

// Route Kelompok Admin (Fitur Admin & Halaman Produk)
Route::name('admin.')->middleware(['auth'])->group(function () {
    // 1. Fitur Admin Khusus (Panel Pengelolaan Admin)
    Route::get('/admin/panel', function () {
        return view('admin.index');
    })->name('index');

    // 2. Halaman Kelola / Katalog Produk (Resource Route)
    Route::resource('products', ProductController::class);
});

// Route Kasir / POS & Keranjang
Route::get('/cashier', [PosController::class, 'index'])->middleware(['auth'])->name('cashier.index');
Route::post('/cart/add/{id}', [PosController::class, 'addToCart'])->name('cart.add');
Route::post('/buy-now/{id}', [PosController::class, 'buyNow'])->name('buy.now');
Route::get('/cart', [PosController::class, 'cartIndex'])->name('cart.index');
Route::post('/checkout', [PosController::class, 'checkout'])->name('checkout.process');

// Route Profil Pelanggan / User Profile
Route::get('/profile', function () {
    return view('profile.index');
})->middleware(['auth'])->name('profile.index');

// Route Authentikasi (Login, Register, Logout)
require __DIR__.'/auth.php';