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

Route::middleware(['auth', 'verified', 'role:kasir'])->group(function () {
    Route::get('/kasir/pelanggan', [NfcCustomerController::class, 'index'])->name('cashier.pelanggan');
    Route::post('/kasir/pelanggan', [NfcCustomerController::class, 'store'])->name('cashier.pelanggan.store');
    Route::post('/kasir/pelanggan/{customer}/top-up', [NfcCustomerController::class, 'topUp'])->name('cashier.pelanggan.top-up');
    Route::post('/kasir/kartu/saldo', [SaleController::class, 'nfcBalance'])->name('cashier.nfc.balance');
    Route::post('/kasir/transaksi', [SaleController::class, 'store'])->name('cashier.checkout');

    // Rute cetak struk bawaan Anda sebelumnya
    Route::post('/kasir/riwayat/{sale}/struk', [StrukController::class, 'printReceipt'])->name('cashier.receipt.print');

    /**
     * Penambahan Rute dari Gambar 3 (Generate PDF Invoice)
     * Menggunakan method GET agar link download PDF bisa langsung dibuka/diklik lewat browser.
     * Menggunakan {sale} untuk mencocokkan model Sale di StrukController Anda.
     */
    Route::get('/kasir/riwayat/{sale}/invoice', [StrukController::class, 'invoice'])->name('cashier.invoice.download');

    Route::get('/kasir/riwayat', [SaleController::class, 'index'])->name('cashier.riwayat');

    Route::get('/kasir', function () {
        return view('kasir.dashboard');
    })->name('cashier.dashboard');
});

// Memuat route autentikasi (Login, Register, Logout)
require __DIR__.'/auth.php';