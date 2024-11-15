<?php

namespace App\Http\Controllers;

use App\Models\obat;
use Illuminate\Http\Request;

class ObatController extends Controller

{
    public function showObat()
    {
        $obat = obat::all();
        // dd($obat);
        return view('admin.obat.index', compact('obat'));
    }

    public function createObat(Request $request)
    {
        return view('admin.obat.create');
    }

    public function storeObat(Request $request)
{
    // Validasi data yang masuk
    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'satuan' => 'required|string|max:100',
        'stok' => 'required',
    ]);

    // Simpan data ke dalam database
    $obat = new Obat();
    $obat->nama_obat = $validatedData['nama'];
    $obat->satuan_terkecil = $validatedData['satuan'];
    $obat->status = $validatedData['stok'];  // Make sure 'stok' is the correct column'
    // dd($obat);
    $obat->save();  // Automatically adds created_at and updated_at

    // Redirect dengan pesan sukses
    return redirect()->route('obat')->with('success', 'Data obat berhasil disimpan.');
}


    public function update(Request $request, $id)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'satuan' => 'required|string|max:100',
            'stok' => 'required|integer',
        ]);

        // Temukan data obat berdasarkan ID
        $obat = Obat::findOrFail($id);

        // Update data obat
        $obat->update([
            'nama_obat' => $validatedData['nama'],
            'satuan_terkecil' => $validatedData['satuan'],
            'status' => $validatedData['stok'],
        ]);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Data obat berhasil diperbarui.');
    }


    public function destroy($id)
    {
        // Temukan data obat berdasarkan ID
        $obat = Obat::findOrFail($id);

        // Hapus data obat
        $obat->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data obat berhasil dihapus.');
    }
}
