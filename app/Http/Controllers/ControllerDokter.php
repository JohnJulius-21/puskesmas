<?php

namespace App\Http\Controllers;

use App\Models\Dokter;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ControllerDokter extends Controller
{
    
    public function index()
    {
        $doctors = Dokter::all();
        return view('dokter.index', compact('doctors'));
    }

  
     public function store(Request $request)
    { 
        $validatedData = $request->validate([
        'name' => 'required|string',
        'spesialis' => 'required|string',
        'status' => 'required|in:active,inactive',
        'no_telp' => 'required|string', 
        'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    // dd($validatedData['foto']);
    if ($request->hasFile('foto')) {
        $image = $request->file('foto');
        $imageName = date('Y-m-d'). $image->getClientOriginalName();
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
        return redirect()->route('dokter.index')->with('success', 'Data berhasil disimpan.');
    }
      


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
