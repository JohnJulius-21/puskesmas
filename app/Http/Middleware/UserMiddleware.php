<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user yang sedang login adalah user biasa (non-admin)
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            if ($user->role_id == 2) {
                return $next($request); // Lanjutkan jika user
            }
        }

        // Jika user yang login adalah admin, redirect ke halaman admin
        return redirect()->route('pasien')->withErrors('Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}

