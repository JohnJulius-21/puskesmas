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
        } 
         // Check if user is a dokter (doctor)
         elseif ($user->role_id == 2) { // Assuming 2 is the role_id for dokter
            // Attempt login with 'dokter' guard (you need to define this guard in config/auth.php)
            if (Auth::guard('dokter')->attempt($credentials)) {
                return redirect()->route('pasien'); // Redirect to dokter's dashboard (replace with actual route)
            } else {
                return redirect()->back()->withInput($request->only('email'))->withErrors([
                    'password' => 'Incorrect password for dokter.',
                ]);
            }
        }
   
        else {
            // Coba login sebagai user biasa dengan guard 'web'
            if (Auth::guard('web')->attempt($credentials)) {
                return redirect()->route('beranda'); // Arahkan ke halaman beranda user
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
    
        // Kirim pesan logout untuk admin
        return redirect()->route('login')->with('status', 'Admin berhasil logout.');
    }
    
    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout(); // Logout dari guard 'web'
        $request->session()->invalidate(); // Hapus sesi
        $request->session()->regenerateToken(); // Regenerasi token untuk keamanan
    
        // Kirim pesan logout untuk user biasa
        return redirect()->route('login')->with('status', 'User berhasil logout.');
    }
    
    public function dokterLogout(Request $request)
    {
        // Logout dari guard 'dokter'
        Auth::guard('dokter')->logout();
        
        // Hapus sesi dan regenerasi token untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect ke halaman login dengan pesan untuk dokter
        return redirect()->route('login')->with('status', 'Dokter berhasil logout.');
    }
    

}
