<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Izinkan semua user yang sudah login melewati middleware ini
        if ($request->user()) {
            return $next($request);
        }

        abort(403, 'AKSES DITOLAK: ROLE ANDA TIDAK MEMILIKI IZIN UNTUK HALAMAN INI.');
    }
}