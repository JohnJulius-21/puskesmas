<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\jenis_layanan;
use App\Models\konsultasi;
use App\Models\pasien;
use App\Models\resep;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

use Carbon\Carbon; // Ensure to import Carbon for date handling
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

        // Ambil semua data konsultasi yang terkait dengan user yang sedang login
        $konsultasi = konsultasi::with(['dokter', 'pasien']) // eager load dokter dan pasien
            ->whereHas('pasien', function ($query) use ($user) {
                $query->where('user_id', $user->id); // Filter konsultasi berdasarkan user_id dari pasien
            })
            ->get();

        // dd($konsultasi);

        // Ambil semua data resep yang terkait dengan pasien yang sesuai dengan user_id yang login
        // Filter resep berdasarkan pasien_id yang sesuai dengan konsultasi
        $resep = resep::with('obat')
            ->whereHas('pasien', function ($query) use ($user) {
                $query->where('user_id', $user->id); // Filter resep berdasarkan user_id dari pasien
            })
            ->get();
        // dd($resep);

        // Cek apakah data konsultasi ditemukan atau tidak
        $message = $konsultasi->isEmpty() ? 'Tidak ada data konsultasi yang ditemukan untuk pasien ini.' : 'Jumlah konsultasi ditemukan: ' . $konsultasi->count();

        // Return view dengan data konsultasi, resep, dan pesan
        return view('user.konsultasi.show', compact('konsultasi', 'resep', 'message'));
    }



    // public function show()
    // {
    //     // Ambil user yang sedang login
    //     $user = auth()->user();

    //     // Ambil pasien berdasarkan patient_id yang sesuai dengan user_id
    //     $pasien = pasien::where('user_id', $user->id)->first();
    //     dd($pasien);

    //     if ($pasien) {
    //         // Ambil semua konsultasi yang sesuai dengan patient_id dari pasien
    //         //  dd($pasien->id);
    //         $konsultasiQuery = konsultasi::with('dokter')
    //         ->where('patient_id', $pasien->id);

    //     // Debugging query
    //     // dd($konsultasiQuery->toSql(), $konsultasiQuery->getBindings());

    //     $konsultasi = $konsultasiQuery->get();


    //         // Ambil semua resep yang sesuai dengan patient_id dari pasien
    //         $resep = resep::with('obat')
    //             ->where('patient_id', $pasien->id)
    //             ->get(); // Mengambil semua resep dari pasien ini

    //         // Jika hanya satu konsultasi yang ditampilkan, bisa jadi masalah di view
    //         // Untuk memastikan semua data konsultasi tampil, cek jumlah datanya di controller
    //         if ($konsultasi->isEmpty()) {
    //             // Jika tidak ada konsultasi
    //             $message = 'Tidak ada data konsultasi yang ditemukan untuk pasien ini.';
    //         } else {
    //             // Tampilkan jumlah konsultasi untuk debugging
    //             $message = 'Jumlah konsultasi ditemukan: ' . $konsultasi->count();
    //         }

    //         // Debug jumlah konsultasi jika perlu
    //         // dd($konsultasi->count());

    //     } else {
    //         // Jika tidak ada pasien ditemukan, kirim data kosong
    //         $konsultasi = collect();
    //         $resep = collect();
    //         $message = 'Pasien tidak ditemukan.';
    //     }

    //     // Return view dengan data konsultasi dan resep
    //     return view('user.konsultasi.show', compact('konsultasi', 'resep', 'message'));
    // }

    public function riwayat()
    {
        // Ambil user yang sedang login
        $user = auth()->user();

        // Ambil pasien berdasarkan user_id
        $pasien = pasien::where('user_id', $user->id)->first();

        // Cek apakah pasien ditemukan
        if ($pasien) {
            // Ambil data riwayat konsultasi berdasarkan patient_id
            $riwayatKonsultasi = konsultasi::with('dokter')
                ->where('patient_id', $pasien->id)
                ->orderBy('created_at', 'desc')
                ->get();

            // Ambil resep terkait dengan pasien
            $resep = resep::with('obat')
                ->where('patient_id', $pasien->id)
                ->get(); // Use get() to retrieve all prescriptions

            // Gabungkan riwayat konsultasi dan resep ke dalam koleksi
            $combinedData = $riwayatKonsultasi->map(function ($konsultasi) use ($resep) {
                // Filter prescriptions for this consultation based on shared patient ID
                $konsultasi->resep = $resep->where('patient_id', $konsultasi->patient_id);
                return $konsultasi;
            });
        } else {
            $combinedData = collect(); // Jika tidak ada pasien, return koleksi kosong
        }
        // dd($combinedData); // Debugging untuk melihat hasil penggabungan

        return view('user.konsultasi.riwayat', compact('combinedData'));
    }


    public function showRiwayatKonsultasi()
    {
        // Ambil user yang sedang login
        $user = auth()->user();
        // dd($user);

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
        // dd($konsultasi);

        return view('user.riwayat', compact('konsultasi', 'resep'));
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
            'status' => 'nullable|string',
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
        $konsultasi->status = 'pending'; // Set default status
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
    public function updateStatus(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'status' => 'required|string',
        ]);

        // Find the consultation by ID
        $konsultasi = konsultasi::findOrFail($id);

        // Update the status
        $konsultasi->status = $request->status;
        $konsultasi->save();

        // Update the corresponding patient status
        if ($konsultasi->pasien) { // Ensure there is an associated patient
            $pasien = $konsultasi->pasien;
            $pasien->status = $konsultasi->status; // Sync the status
            $pasien->save();
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Status updated successfully!');
    }
    public function riwayatAntrian(Request $request)
    {
        // Start the query
        $query = konsultasi::with('dokter', 'pasien')
            ->orderBy('created_at', 'desc');

        // Check if both start and end dates are provided, along with optional times
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            try {
                // Parse start and end dates with optional times
                $startDateTime = Carbon::parse($request->input('tanggal_mulai') . ' ' . ($request->input('time_mulai') ?? '00:00:00'));
                $endDateTime = Carbon::parse($request->input('tanggal_selesai') . ' ' . ($request->input('time_selesai') ?? '23:59:59'));

                // Apply the date and time range filter
                $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
            } catch (\Exception $e) {
                return back()->with('error', 'Format tanggal atau waktu tidak valid.');
            }
        }

        // Apply status filter if provided
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Get the results
        $riwayatAntrian = $query->get();

        // Return the view with filtered data
        return view('admin.riwayat.index', compact('riwayatAntrian'));
    }
    public function exportRiwayatAntrian(Request $request)
    {
        // Validate the date range: tanggal_mulai cannot be later than tanggal_selesai
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            try {
                $startDate = Carbon::parse($request->input('tanggal_mulai'));
                $endDate = Carbon::parse($request->input('tanggal_selesai'));

                // Check if the start date is later than the end date
                if ($startDate->greaterThan($endDate)) {
                    return back()->with('error', 'Tanggal mulai tidak boleh lebih besar dari tanggal selesai.');
                }
            } catch (\Exception $e) {
                return back()->with('error', 'Format tanggal atau waktu tidak valid.');
            }
        } else {
            return back()->with('error', 'Tanggal mulai dan tanggal selesai harus diisi.');
        }

        // Initialize the query
        $query = konsultasi::with('dokter', 'pasien')
            ->orderBy('tanggal_konsultasi', 'desc');

        // Apply date and time filters if provided
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            try {
                // Parse dates with optional times
                $startDateTime = Carbon::parse($request->input('tanggal_mulai') . ' ' . ($request->input('time_mulai') ?? '00:00:00'));
                $endDateTime = Carbon::parse($request->input('tanggal_selesai') . ' ' . ($request->input('time_selesai') ?? '23:59:59'));

                // Apply the date and time range filter
                $query->whereBetween('tanggal_konsultasi', [$startDateTime, $endDateTime]);
            } catch (\Exception $e) {
                return back()->with('error', 'Format tanggal atau waktu tidak valid.');
            }
        } else {
            return back()->with('error', 'Tanggal mulai dan tanggal selesai harus diisi.');
        }

        // Fetch the records
        $riwayatAntrian = $query->get();

        if ($riwayatAntrian->isEmpty()) {
            return back()->with('error', 'Tidak ada data yang ditemukan untuk ekspor.');
        }

        // Initialize a new spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Tanggal');
        $sheet->setCellValue('B1', 'Dokter');
        $sheet->setCellValue('C1', 'Nama Pasien');
        $sheet->setCellValue('D1', 'Keluhan');
        $sheet->setCellValue('E1', 'Status');

        // Fill in the data
        $row = 2;
        foreach ($riwayatAntrian as $konsultasi) {
            $dokterName = $konsultasi->dokter ? $konsultasi->dokter->name : 'Dokter tidak ditemukan';
            $pasienName = $konsultasi->pasien ? $konsultasi->pasien->nama_pasien : 'Pasien tidak ditemukan';

            $sheet->setCellValue('A' . $row, \Carbon\Carbon::parse($konsultasi->tanggal_konsultasi)->format('d-m-Y H:i:s'));
            $sheet->setCellValue('B' . $row, $dokterName);
            $sheet->setCellValue('C' . $row, $pasienName);
            $sheet->setCellValue('D' . $row, $konsultasi->keluhan);
            $sheet->setCellValue('E' . $row, $konsultasi->status);
            $row++;
        }

        // Generate dynamic file name
        $fileName = 'Riwayat_Antrian';
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $fileName .= '_tanggal_' . Carbon::parse($request->tanggal_mulai)->format('d-m-Y') . '_sampai_' . Carbon::parse($request->tanggal_selesai)->format('d-m-Y');
        }
        $fileName .= '.xlsx';

        // Save the file to a temporary location and return it for download
        $pathToFile = storage_path('app/public/' . $fileName);
        $writer = new Xlsx($spreadsheet);
        $writer->save($pathToFile);

        // Return the file as a download response
        return response()->download($pathToFile)->deleteFileAfterSend(true);
    }


    public function cetakResep($id)
    {
        // Retrieve the relevant consultation (konsultasi) and associated prescriptions (resep)
        $konsultasi = konsultasi::with('dokter', 'pasien')->findOrFail($id);
        $resep = resep::with('obat')->where('id', $id)->get();

        // Check if consultation and prescriptions exist
        if (!$konsultasi || $resep->isEmpty()) {
            return redirect()->back()->with('error', 'Data konsultasi atau resep tidak ditemukan.');
        }

        // Prepare data for the PDF view
        $data = [
            'konsultasi' => $konsultasi,
            'resep' => $resep,
            'tanggal' => Carbon::now()->format('d-m-Y'),
            'user' => auth()->user(),
        ];
        // dd($data);
        // Generate the PDF from the view
        $pdf = Pdf::loadView('user.konsultasi.resep', $data);
        // $test = PDF::loadView('user.konsultasi.resep');
        // return view('user.konsultasi.resep', $data);
        // Return the generated PDF file to download
        return $pdf->download('resep-konsultasi' . $konsultasi->id . '.pdf');
    }

    // app/Http/Controllers/KonsultasiController.php

    public function generatePDF($id)
    {
        // Ambil konsultasi berdasarkan ID
        $konsultasi = Konsultasi::findOrFail($id);

        // Ambil semua resep yang sesuai dengan patient_id yang sama dengan konsultasi
        $resep = Resep::where('patient_id', $konsultasi->patient_id)->get();

        // Pastikan resep ada
        if ($resep->isEmpty()) {
            return response()->json(['message' => 'No resep found for this patient.'], 404);
        }

        // Generate PDF menggunakan domPDF atau MPDF
        $pdf = PDF::loadView('user.konsultasi.resep', compact('konsultasi', 'resep'));

        return $pdf->download('resep-' . $konsultasi->id . '.pdf');
    }
}
