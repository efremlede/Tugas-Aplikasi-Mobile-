<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role ?? Auth::user()->usertype ?? null;

        if (! in_array($userRole, $roles, true)) {
            abort(403, 'Akses Ditolak: role Anda tidak memiliki izin untuk halaman ini.');
        }

        return $next($request);
    }
}
