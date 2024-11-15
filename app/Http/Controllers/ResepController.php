<?php

namespace App\Http\Controllers;

use App\Models\dokter;
use App\Models\pasien;
use App\Models\konsultasi;
use App\Models\obat;
use App\Models\resep;
use Illuminate\Http\Request;
use PDF;

class ResepController extends Controller
{
    public function index()
{
    // Ambil semua resep beserta pasien dan obat
    $resep = resep::with('pasien', 'obat','konsultasi')->get();
    // dd($resep);

    // Ambil semua konsultasi beserta dokter
    $konsultasi = konsultasi::with('dokter')->get();

    // Kirim resep dan konsultasi ke view
    return view("admin.resep.index", compact("resep", "konsultasi"));
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
            // 'dokter' => 'required|exists:dokters,id',
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
    public function reschedule($id)
{
    // Find the existing consultation
    $consultation = konsultasi::findOrFail($id);

    // Logic to show the rescheduling form (you can pass any needed data)
    return view('reschedule', compact('consultation'));
}
public function riwayat()
{
    // Fetch the prescription data, along with related patient and doctor information
    $riwayat = Resep::with('pasien', 'obat', 'dokter')->get();

    return view('admin.riwayat_antrian', compact('riwayat'));
}
    
//    public function downloadpdf()
//    {
//     $resep = resep::limit(20)->get();
//     $pdf = PDF::loadView('resep', compact('',''));
//    } 
    
}
