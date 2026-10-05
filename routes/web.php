<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Rute Halaman Utama & Login
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// 2. Rute Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// 3. Rute Dashboard dengan Pengecekan Manual (Menampilkan Error 403 jika Belum Login)
Route::get('/dashboard', function () {
    if (!Auth::check()) {
        abort(403, 'THIS ACTION IS UNAUTHORIZED.');
    }

    return view('admin.dashboard');
})->name('dashboard');

// 4. Rute Halaman Post
Route::get('/post', function () {
    return view('post');
});