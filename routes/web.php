<?php

use App\Http\Controllers\Admin\CashierController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\StoreSettingController;
use App\Http\Controllers\Cashier\NfcCustomerController;
use App\Http\Controllers\Cashier\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StrukController;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    // Route POS Kasir Utama
    Route::get('/kasir', function () {
        return view('kasir');
    })->name('cashier.index');

    Route::get('/kasir/index', function () {
        return view('kasir');
    });

    Route::get('/kasir/dashboard', function () {
        return view('kasir.dashboard');
    })->name('cashier.dashboard');

    // Route Transaksi & NFC Kasir
    Route::get('/kasir/pelanggan', [NfcCustomerController::class, 'index'])->name('cashier.pelanggan');
    Route::post('/kasir/pelanggan', [NfcCustomerController::class, 'store'])->name('cashier.pelanggan.store');
    Route::post('/kasir/pelanggan/{customer}/top-up', [NfcCustomerController::class, 'topUp'])->name('cashier.pelanggan.top-up');
    Route::post('/kasir/kartu/saldo', [SaleController::class, 'nfcBalance'])->name('cashier.nfc.balance');
    Route::post('/kasir/transaksi', [SaleController::class, 'store'])->name('cashier.checkout');

    // Route Struk & Invoice (Diubah menjadi GET agar bisa dibuka via window.open)
    Route::get('/kasir/riwayat/{sale}/struk', [StrukController::class, 'printReceipt'])->name('cashier.receipt.print');
    Route::post('/kasir/riwayat/{sale}/struk', [StrukController::class, 'printReceipt']);
    Route::get('/kasir/riwayat/{sale}/invoice', [StrukController::class, 'invoice'])->name('cashier.invoice.download');
    Route::get('/kasir/riwayat', [SaleController::class, 'index'])->name('cashier.riwayat');

    // Route Halaman Produk
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');

    // Route Pendukung & Alias Navigation
    Route::get('/dashboard', function () {
        return redirect()->route('cashier.dashboard');
    })->name('dashboard');

    Route::get('/cashier', function () {
        return redirect()->route('cashier.index');
    });

    // Profile & Admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.index');
    Route::get('/admin', function () {
        return redirect()->route('cashier.dashboard');
    })->name('admin.index');
    
    Route::get('/admin/cashiers', [CashierController::class, 'index'])->name('admin.cashiers.index');
    Route::get('/admin/members', [MemberController::class, 'index'])->name('admin.members.index');
    Route::get('/admin/settings', [StoreSettingController::class, 'index'])->name('admin.settings.index');
});

// Memuat route autentikasi
require __DIR__.'/auth.php';