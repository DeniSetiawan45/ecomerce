<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // CEK 1: Apakah user sudah login?
        if (!Auth::check()) {
            // Belum login → redirect ke halaman login
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        // CEK 2: Apakah user adalah admin?
        if (!Auth::user()->isAdmin()) {
            // Bukan admin → tampilkan error 403 (Forbidden)
            abort(403, 'Akses ditolak! Hanya untuk admin.');
        }

        // Lolos semua pengecekan → lanjut ke controller
        return $next($request);
    }
}