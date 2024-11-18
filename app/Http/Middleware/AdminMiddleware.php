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
        // Pastikan bahwa pengguna terautentikasi dengan guard 'admin'
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
        
            // Cek role_id untuk menentukan akses
            if ($user->role_id == 1) { // Admin
                return $next($request); // Akses diterima untuk Admin
            }
    
            if ($user->role_id == 2) { // Dokter
                // Periksa apakah URL termasuk dalam izin dokter
                if ($request->is('resep*') || $request->is('konsultasi*')) {
                    return $next($request); // Akses diperbolehkan
                }
    
                // Redirect jika mengakses halaman yang tidak diizinkan
                return redirect()->route('resep')->withErrors('Anda tidak memiliki izin untuk mengakses halaman ini.');
            }
        }
    
        // Pastikan bahwa pengguna terautentikasi dengan guard 'dokter'
        if (Auth::guard('dokter')->check()) {
            $user = Auth::guard('dokter')->user();
        
            // Cek role_id untuk menentukan akses
            if ($user->role_id == 2) { // Dokter
                // Periksa apakah URL termasuk dalam izin dokter
                if ($request->is('resep*') || $request->is('pemeriksaan*') || $request->is('dokter/pemeriksaan*')) {
                    return $next($request); // Akses diperbolehkan
                }
                
    
                // Redirect jika mengakses halaman yang tidak diizinkan
                return redirect()->route('resep')->withErrors('Anda tidak memiliki izin untuk mengakses halaman ini.');
            }
        }
    
        // Jika tidak terautentikasi dengan salah satu guard, redirect ke login
        return redirect()->route('login');
    }
    
}
