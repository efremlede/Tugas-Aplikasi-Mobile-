<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Petugas
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $role = Auth::user()->role ?? Auth::user()->usertype ?? null;

        if ($role !== 'petugas') {
            abort(403, 'Akses Ditolak: Anda tidak memiliki izin sebagai petugas.');
        }

        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        \Log::info('Request selesai untuk petugas', ['url' => $request->fullUrl()]);
    }
}
