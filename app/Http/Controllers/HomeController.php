<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Dokter;

class HomeController extends Controller
{
    public function redirect()
    {
        $data = Dokter::all();
        if (Auth::id()) {
            if (Auth::user()->role_id == 1) {
                return view('user.home', compact('data'));
            } else {
                return view('admin.home');
            }
        } else {
            return redirect()->back();
        }
    }
    public function index()

    {
        $data = Dokter::all();

        return view('user.home', compact('data'));
    }
}
