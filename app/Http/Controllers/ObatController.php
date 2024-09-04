<?php

namespace App\Http\Controllers;

use App\Models\obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function showObat()
    {
        $obat = obat::all();
        return view('admin.obat.index', compact('obat'));
    }
}
