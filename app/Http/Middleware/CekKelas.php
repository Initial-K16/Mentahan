<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekKelas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Cek apakah user sudah memilih kelas dengan memeriksa relasi kelas
        if ($user && !$user->kelas()->exists()) {
            return redirect()->route('murid.pilih-kelas')->with('message', 'Silakan pilih kelas terlebih dahulu.');
        }

        return $next($request);
    }
}
