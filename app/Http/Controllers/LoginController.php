<?php

namespace App\Http\Controllers;

use App\Models\pasien;

use Illuminate\Support\Facades\Auth;

use App\Models\User; // Import the User model
use Illuminate\Http\Request; // Import the Request class

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {   
        $pasien = pasien::all();
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->input('email'))->orWhere('unique_name', $request->input('email'))->first();
    
        $uniqueNameCredentials = [
            'unique_name' => $user ? $user->unique_name : null,
            'password' => $request->input('password')
        ];
    
        if ($user && (Auth::attempt($credentials) || Auth::attempt($uniqueNameCredentials))) { 
            if (Auth::user()->role_id == 1) {
                return view('user.home');
            } else {
                return view('admin.pasien.index', compact('pasien'));
            }// Authentication passed, redirect to the home page
            // return redirect()->route('beranda'); // Assuming 'home' is the name of your home page route
        }
    
        // Authentication failed, redirect back with input data
        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }
}

