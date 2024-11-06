<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            // Jika belum login, redirect ke halaman login
            return redirect()->route('login');
        }

        // Cek apakah role user sesuai dengan yang diizinkan
        if (Auth::user()->role !== $role) {
            // Redirect jika user tidak memiliki role yang diizinkan
            return abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}