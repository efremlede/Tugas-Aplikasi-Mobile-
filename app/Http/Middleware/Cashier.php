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
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role ?? Auth::user()->usertype ?? null;

        if ($userRole !== 'kasir') {
            abort(403, 'Akses Ditolak! Anda bukan Kasir.');
        }

        return $next($request);
    }
}