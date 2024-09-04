<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\Doctor;

use App\Http\Controllers\DokterController;
use App\Models\Dokter;

class AdminController extends Controller
{
    public function showHome()
    {
        return view('admin/homeadmin');
    }

    public function addview()
    {
        // Your logic for addview goes here
        return view('admin/homeadmin'); // Assuming you have a corresponding view file
    }

    public function upload(request  $request)
    {
       
        $doctor=new Dokter;

        $image=$request->file; //request gambar

        $imagename=time().'.'.$image->getClientOriginalExtension(); //timefunction

        $request->file->move('doctorimage',$imagename); //pindahkan di folder

        $doctor->foto=$imagename;

        $doctor->name=$request->doctorName;
        $doctor->spesialis=$request->doctorSpecialization;
        $doctor->status=$request->doctorStatus;
        $doctor->foto=$request->imageInput;
        $doctor->no_telp=$request->doctorPhoneNumber;

        $doctor->save();

        return redirect()->back();
    }
    // public function store(Request $request)
    // {
    //      Validasi data input
    //     dd($request->input());
    //     $request->validate([
    //         'doctorName' => 'required|string',
    //         'doctorSpecialization' => 'required|string',
    //         'doctorStatus' => 'required|in:active,inactive',
    //         'no_telp' => 'required|numeric',
    //         'imageInput' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     Proses menyimpan data ke dalam database
    //     $doctor = new Doctor();
    //     $doctor->name = $request->input('doctorName');
    //     $doctor->specialization = $request->input('doctorSpecialization');
    //     $doctor->status = $request->input('doctorStatus');
    //     $doctor->phone_number = $request->input('no_telp');

    //      Simpan gambar jika diunggah
    //     if ($request->hasFile('imageInput')) {
    //         $imagePath = $request->file('imageInput')->store('doctors/images', 'public');
    //         $doctor->image_path = $imagePath;
    //     }

    //     $doctor->save();

    //      Redirect atau berikan respons sesuai kebutuhan Anda
    //     return redirect()->route('your.redirect.route');
    // }
}
