<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// 1. Route Login (Publik)
Route::post('/login', [AuthenticatedSessionController::class, 'login']);

// 2. Route Terproteksi Sanctum
Route::middleware('auth:sanctum')->group(function () {

    // Profil User
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Resource CRUD Buku
    Route::apiResource('books', BookController::class);

    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'logout']);
});