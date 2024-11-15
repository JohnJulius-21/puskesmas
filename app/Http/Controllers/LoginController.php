<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Cari user berdasarkan email atau unique_name
        $user = User::where('email', $request->input('email'))
            ->orWhere('unique_name', $request->input('email'))
            ->first();

        // Jika user ditemukan
        if ($user) {
            // Periksa apakah user adalah admin
            if ($user->role_id == 1) { // role_id 1 diasumsikan sebagai admin
                // Coba login sebagai admin menggunakan guard 'admin'
                if (Auth::guard('admin')->attempt($credentials)) {
                    return redirect()->route('pasien'); // Arahkan ke halaman dashboard admin
                } else {
                    return redirect()->back()->withInput($request->only('email'))->withErrors([
                        'password' => 'Password salah.',
                    ]);
                }
            } else {
                // Jika bukan admin, maka login sebagai user biasa dengan guard 'web'
                $userCredentials = [
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                ];

                $uniqueNameCredentials = [
                    'unique_name' => $user->unique_name,
                    'password' => $request->input('password'),
                ];

                // Coba login sebagai user biasa dengan guard 'web'
                if (Auth::guard('web')->attempt($userCredentials) || Auth::guard('web')->attempt($uniqueNameCredentials)) {
                    return redirect()->route('beranda'); // Arahkan ke halaman user
                } else {
                    return redirect()->back()->withInput($request->only('email'))->withErrors([
                        'password' => 'Password salah.',
                    ]);
                }
            }
        }

        // Jika user tidak ditemukan
        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'User tidak ditemukan.',
        ]);
    }

    // public function logout(Request $request)
    // {
    //     if (Auth::guard('admin')->check()) {
    //         // Jika admin sedang login, logout dari guard admin
    //         Auth::guard('admin')->logout();
    //         $request->session()->invalidate();
    //         $request->session()->regenerateToken();
    //         return redirect()->route('login')->with('status', 'Admin berhasil logout.');
    //     } elseif (Auth::guard('web')->check()) {
    //         // Jika user biasa sedang login, logout dari guard web
    //         Auth::guard('web')->logout();
    //         $request->session()->invalidate();
    //         $request->session()->regenerateToken();
    //         return redirect()->route('login')->with('status', 'User berhasil logout.');
    //     }

    //     return redirect()->route('login')->with('status', 'Anda tidak sedang login.');
    // }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout(); // Logout dari guard 'admin'
        $request->session()->invalidate(); // Hapus sesi
        $request->session()->regenerateToken(); // Regenerasi token untuk keamanan

        return redirect()->route('login')->with('status', 'Admin berhasil logout.');
    }

    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout(); // Logout dari guard 'admin'
        $request->session()->invalidate(); // Hapus sesi
        $request->session()->regenerateToken(); // Regenerasi token untuk keamanan

        return redirect()->route('login')->with('status', 'User berhasil logout.');
    }
}
