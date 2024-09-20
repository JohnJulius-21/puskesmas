<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\jenis_layanan;
use App\Models\konsultasi;
use App\Models\pasien;
use App\Models\resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        $dokter = Dokter::all();
        $layanan = jenis_layanan::all();
        // dd($dokter);
        return view('user.konsultasi.create', [
            'user' => $user,
            'dokter' => $dokter,
            'layanan' => $layanan,
        ]);
    }

    public function show()
    {
        // Ambil user yang sedang login
        $user = auth()->user();

        // Ambil pasien berdasarkan patient_id yang sesuai dengan user_id
        $pasien = pasien::where('user_id', $user->id)->first();


        if ($pasien) {
            // Ambil konsultasi yang sesuai dengan kolom patient_id dari pasien
            $konsultasi = konsultasi::with('dokter')
                ->where('patient_id', $pasien->id)
                ->get();

            // Ambil resep yang sesuai dengan kolom patient_id dari pasien
            $resep = resep::with('obat')
                ->where('patient_id', $pasien->id)
                ->get();
            // dd($resep);
        } else {
            $konsultasi = collect(); // Jika tidak ada pasien, return koleksi kosong
            $resep = collect(); // Jika tidak ada pasien, return koleksi kosong
        }

        return view('user.konsultasi.show', compact('konsultasi','resep'));
    }



    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'status' => 'required',
            'nomor_bpjs' => 'nullable|string|max:13',
            'tanggal_konsultasi' => 'required|date_format:Y-m-d\TH:i',
            'jenis_layanan' => 'required|integer',
            'dokter' => 'required|integer',
            'keluhan' => 'required|nullable|string',
            'riwayat' => 'required|nullable|string',
        ], [
            'nama.required' => 'Nama pasien wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'no_hp.required' => 'Nomor telepon wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'tanggal_konsultasi.required' => 'Tanggal konsultasi wajib diisi.',
            'jenis_layanan.required' => 'Jenis layanan wajib dipilih.',
            'dokter.required' => 'Dokter wajib dipilih.',
            'keluhan.required' => 'Keluhan pasien wajib diisi.',
            'riwayat.required' => 'Riwayat penyakit wajib diisi.',
        ]);

        // Simpan data ke dalam database
        $konsultasi = new pasien();
        $konsultasi->nama_pasien = $validatedData['nama'];
        $konsultasi->nik = $validatedData['nik'];
        $konsultasi->jenis_kelamin = $validatedData['jenis_kelamin'];
        $konsultasi->tanggal_lahir = $validatedData['tanggal_lahir'];
        $konsultasi->alamat = $validatedData['alamat'];
        $konsultasi->no_hp = $validatedData['no_hp'];
        $konsultasi->status = $validatedData['status'];
        $konsultasi->nomor_bpjs = $validatedData['nomor_bpjs'];
        $konsultasi->tanggal_konsultasi = $validatedData['tanggal_konsultasi'];
        $konsultasi->id_jenis_layanan = $validatedData['jenis_layanan'];
        $konsultasi->id_dokter = $validatedData['dokter'];
        $konsultasi->keluhan = $validatedData['keluhan'];
        $konsultasi->riwayat = $validatedData['riwayat'];
        $konsultasi->user_id = Auth::id();
        // dd($konsultasi);
        $konsultasi->save();

        // Berikan response setelah data berhasil disimpan
        return redirect()->route('konsultasiShow')->with('success', 'Data konsultasi berhasil disimpan!, Data konsultasi anda sedang diproses!');
    }
}
