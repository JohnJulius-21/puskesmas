<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use App\Models\pasien;
use App\Models\konsultasi;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
    public function index()
    {
        $konsultasi = Konsultasi::with('pasien', 'dokter')->get();
        return view('admin.konsultasi.index', compact('konsultasi'));
    }
    

    public function create()
    {
        $pasien = pasien::all();
        $dokter = dokter::all();
        return view("admin.konsultasi.create", compact("pasien", "dokter"));
    }

    public function getPatientInfo($id)
    {
        $pasien = Pasien::find($id);
        return response()->json($pasien);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $validatedData = $request->validate([
            'pasien' => 'required|exists:pasien,id',
            'dokter' => 'required|exists:dokters,id',
        ]);

        // Cek ketersediaan jadwal dokter
        // $schedule = Schedule::where('doctor_id', $request->dokter)
        //     ->where('start_time', '<=', $request->tanggal_konsultasi)
        //     ->where('end_time', '>=', $request->tanggal_konsultasi)
        //     ->first();

        // if (!$schedule) {
        //     return back()->withErrors(['tanggal_konsultasi' => 'Dokter tidak tersedia pada tanggal tersebut.']);
        // }

        // Ambil nomor antrian terakhir
        // $latestQueue = konsultasi::where('doctor_id', $request->dokter)
        //     ->max('queue');

        // $validatedData['queue'] = $latestQueue ? $latestQueue + 1 : 1;


        // Menyimpan data field form ke database
        $konsultasi = new konsultasi();
        $konsultasi->doctor_id = $request->dokter;
        $konsultasi->patient_id = $request->pasien;
        $konsultasi->jenis_kelamin = $request->jenis_kelamin;
        $konsultasi->tanggal_lahir = $request->tanggal_lahir;
        $konsultasi->tanggal_konsultasi = Carbon::parse($request->tanggal_konsultasi);
        $konsultasi->keluhan = $request->keluhan;
        $konsultasi->riwayat = $request->riwayat;

        // Mengatur nomor antrian
        $latestQueue = konsultasi::where('doctor_id', $request->dokter)->max('queue');
        $konsultasi->queue = $latestQueue ? $latestQueue + 1 : 1;
        $konsultasi->save();

        // Simpan data konsultasi
        // konsultasi::create([
        //     'patient_id' => $validatedData['pasien'],
        //     'doctor_id' => $validatedData['dokter'],
        //     'tanggal_konsultasi' => $validatedData['tanggal_konsultasi'],
        //     'keluhan' => $validatedData['keluhan'],
        //     'riwayat' => $validatedData['riwayat'],
        //     'queue' => $validatedData['queue'],
        // ]);

        return redirect()->route('pemeriksaan')->with('success', 'Konsultasi berhasil disimpan.');
    }

    public function destroy($id)
    {
        
    }
}
