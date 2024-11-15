<?php

use Laravel\Fortify\Fortify;

use App\Http\Controllers\Data_Obat;


use App\Http\Controllers\Data_Pasien;

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\ObatController;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\LoginController;

use App\Http\Controllers\ControllerDokter;

use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\ResepController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/user/logout', [LoginController::class, 'userLogout'])->name('user.logout');
Route::post('/logout', [LoginController::class, 'adminLogout'])->name('adminLogout');



Fortify::registerView(function () {
    return view('auth.register'); // Assuming your registration form view is in resources/views/auth/register.blade.php
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');


// Route::post('/upload_doctor', [DokterController::class, 'store'])->name('add-doctor-store');






Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/add_doctor_view', [AdminController::class, 'addview']);


Route::group(['middleware' => ['admin']], function () {
    Route::get('/data_pasien', [PasienController::class, 'index'])->name('pasien');
    Route::post('/hapusPasien/{id}', [PasienController::class, 'destroy'])->name('hapusPasien');
    Route::get('/tambah_pasien', [PasienController::class, 'create'])->name('tambahPasien');
    Route::post('/simpan_pasien', [PasienController::class, 'store'])->name('pasienStore');


    Route::get('/add_doctor_dokter', [DokterController::class, 'showDoctor'])->name('show.doctor');
    Route::get('/tambah_dokter', [DokterController::class, 'create']);

    Route::get('/data_obat', [ObatController::class, 'showObat'])->name('obat');
    Route::get('/data_obat/tambah_obat', [ObatController::class, 'createObat'])->name('tambahObat');
    Route::post('/simpan_obat', [ObatController::class, 'storeObat'])->name('simpanObat');
    Route::post('/hapus_obat/{id}', [ObatController::class, 'destroy'])->name('hapusObat');
    Route::post('/hapus_obat/{id}', [ObatController::class, 'destroy'])->name('hapusObat');
    Route::put('/updateObat/{id}', [ObatController::class, 'update'])->name('updateObat');


    Route::get('/homeadmin', [AdminController::class, 'showHome']);
    Route::get('/show_doctor', [DokterController::class, 'showDoctor']);
    Route::post('/add_doctor_dokter', [DokterController::class, 'addDoctor'])->name('add.doctor');
    Route::delete('/delete_doctor/{id}', [DokterController::class, 'delete'])->name('delete-doctor');
    Route::resource('/dokter', ControllerDokter::class);


    Route::get('/pemeriksaan', [PemeriksaanController::class, 'index'])->name('pemeriksaan');
    Route::post('/hapusPemeriksaan', [PemeriksaanController::class, 'destroy'])->name('hapusPemeriksaan');
    Route::get('/pemeriksaan/tambah_pemeriksaan', [PemeriksaanController::class, 'create'])->name('tambahPemeriksaan');
    Route::post('/simpan_pemeriksaan', [PemeriksaanController::class, 'store'])->name('simpanPemeriksaan');
    Route::get('/get-patient-info/{id}', [PemeriksaanController::class, 'getPatientInfo']);
    Route::patch('/konsultasi/{id}/updateStatus', [KonsultasiController::class, 'updateStatus'])->name('updateStatus');
    Route::get('/resep', action: [ResepController::class, 'index'])->name('resep');
    Route::get('/resep/tambahResep', [ResepController::class, 'create'])->name('tambahResep');
    Route::post('/resep/simpanResep', [ResepController::class, 'store'])->name('simpanResep');
    Route::get('export-riwayat-antrian', [KonsultasiController::class, 'exportRiwayatAntrian'])->name('export.riwayat.antrian');
    Route::get('/riwayat_antrian', [KonsultasiController::class, 'riwayatAntrian'])->name('riwayat_antrian');
});

Route::get('/', function () {
    return redirect()->route('beranda'); // Mengarahkan ke route 'beranda'
});

Route::get('/beranda', [HomeController::class, 'index'])->name('beranda');

Route::group(['middleware' => ['user']], function () {

    // Route::get('/home', [HomeController::class, 'redirect'])->name('home');


    // Route::get('/user/home', [UserController::class, 'index'])->name('user.home');



});
Route::get('/konsultasi', [KonsultasiController::class, 'create'])->middleware('auth')->name('konsultasi');
Route::get('/konsultasi/konsultasiShow', [KonsultasiController::class, 'show'])->middleware('auth')->name('konsultasiShow');
Route::post('/konsultasiStore', [KonsultasiController::class, 'store'])->middleware('auth')->name('konsultasiStore');

Route::get('/riwayat-konsultasi', [KonsultasiController::class, 'riwayat'])->middleware('auth')->name('riwayatKonsultasi');
// Route::get('/download-resep.pdf', [ResepController::class, 'downloadPdf'])->name('downloadpdf');
Route::get('/reschedule/{id}', [ResepController::class, 'reschedule'])->middleware('auth')->name('reschedule');

Route::get('/cetak-resep/{id}', [KonsultasiController::class, 'cetakResep'])->name('cetak-resep');

Route::get('/check-extensions', function () {
    return response()->json(get_loaded_extensions());
});
Route::get('/ekspor-riwayat', [KonsultasiController::class, 'exportRiwayatAntrian'])->name('ekspor.riwayat');

Route::get('/generate-pdf/{id}', [KonsultasiController::class, 'generatePDF'])->name('generate.pdf');
