<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
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
        
        // Cek apakah user sedang login melalui guard 'admin'
        if (Auth::guard('admin')->check()) {
            // Cek apakah role_id user adalah 1 (admin)
            $user = Auth::guard('admin')->user();
            
            if ($user->role_id == 1) {
                return $next($request); // Lanjutkan jika admin
            }
        }

        // Jika bukan admin atau role_id tidak sesuai, redirect ke halaman yang diinginkan
        return redirect()->route('resep')->withErrors('Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
