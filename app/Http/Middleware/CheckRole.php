<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class CheckRole 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;

        // Jika role BUKAN 'admin' DAN BUKAN 'dev', maka tampilkan 403
        if ($userRole !== 'admin' && $userRole !== 'dev') {
            abort(403, 'Akses Ditolak: Hanya Admin dan Developer yang diizinkan untuk mengelola menu aplikasi.');
        }

        return $next($request);
    }
}