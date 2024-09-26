<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\pasien;
use App\Models\jenis_layanan;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = pasien::all();
        // dd($pasien);
        return view('admin.pasien.index', compact('pasien'));
    }

    public function create()
    {
        // $pasien = pasien::all();
        $dokter = Dokter::all();
        $layanan = jenis_layanan::all();
        // dd($pasien);
        return view('admin.pasien.create', compact('dokter', 'layanan'));
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
        $konsultasi->save();

        // Berikan response setelah data berhasil disimpan
        return redirect()->route('pasien')->with('success', 'Data konsultasi berhasil disimpan!');
    }

    public function destroy($id)
    {
        // Temukan data pasien berdasarkan ID
        $pasien = Pasien::findOrFail($id);

        // Hapus data pasien
        $pasien->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data pasien berhasil dihapus.');
    }
}
