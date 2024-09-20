<?php

namespace App\Http\Controllers;

use App\Models\dokter;
use App\Models\pasien;
use App\Models\konsultasi;
use App\Models\obat;
use App\Models\resep;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    public function index()
    {
        $resep = resep::with('pasien', 'obat')->get();
        return view("admin.resep.index", compact("resep"));
    }

    public function create()
    {
        $pasien = pasien::all();
        $konsultasi = konsultasi::with('pasien', 'dokter')->get();
        // dd($konsultasi);
        $dokter = dokter::all();
        $obat = obat::all();
        return view("admin.resep.create", compact("pasien", "obat", "dokter", "konsultasi"));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'pasien' => 'required|exists:pasien,id',
            'obat' => 'required|exists:obat,id',
            'laporan' => 'required|string',
            'catatan' => 'nullable|string',
        ]);
        // dd($request);

        $resep = new resep();
        $resep->patient_id = $request->pasien;
        $resep->obat_id = $request->obat;
        $resep->laporan = $request->laporan;
        $resep->catatan = $request->catatan;
        // dd($resep);
        $resep->save();

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('resep') // ganti dengan route yang sesuai
            ->with('success', 'Resep berhasil disimpan!');
    }
}
