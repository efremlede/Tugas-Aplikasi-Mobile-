<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Cashier
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login
        if (Auth::check()) {
            // Cek apakah role user adalah 'kasir'
            if (Auth::user()->role == 'kasir') {
                return $next($request);
            } else {
                // Tampilkan halaman 403 dengan pesan custom
                abort(403, 'Akses Ditolak! Anda bukan Kasir.');
            }
        }

        return redirect()->route('login');
    }
}