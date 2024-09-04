<?php

namespace App\Http\Controllers;

use App\Models\Dokter;




use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function showDoctor()
    {
        $doctors = Dokter::all();
        return view('admin.dokter.show', compact('doctors'));
    }

    public function create()
    {
        // $doctors = Dokter::all();
        return view('admin.dokter.create');
    }

    public function addDoctor(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string',
            'spesialis' => 'required',
            'status' => 'required',
            'no_telp' => 'required|string',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Nama dokter wajib diisi.',
            'spesialis.required' => 'Spesialisasi dokter wajib dipilih.',
            'status.required' => 'Status dokter wajib dipilih.',
            'no_telp.required' => 'Nomor telepon wajib diisi.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Format gambar yang diperbolehkan hanya: jpeg, png, jpg, gif.',
            'foto.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ]);
        
        // dd($validatedData['foto']);
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = date('Y-m-d') . $image->getClientOriginalName();
            $path = $image->storeAs('public/doctor_images', $imageName);
            // dd($path); // Debug path setelah penyimpanan gambar
        } else {
            $path = null; // Set default path if no image is uploaded
        }


        $dokter = Dokter::create([
            'name' => $validatedData['name'],
            'spesialis' => $validatedData['spesialis'],
            'status' => $validatedData['status'],
            'no_telp' => $validatedData['no_telp'],
            'foto' => $path,
        ]);


        $dokter->save();
        return redirect('/add_doctor_dokter')->with('success', 'Data berhasil disimpan.');
    }


    public function delete($id)
    {
        // Find the doctor by ID
        $doctor = Dokter::findOrFail($id);

        // Delete the doctor
        $doctor->delete();

        // Redirect back or wherever needed
        return redirect()->back()->with('success', 'Doctor deleted successfully');
    }
}
