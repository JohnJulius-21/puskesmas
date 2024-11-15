<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class konsultasi extends Model
{
    use HasFactory;
    protected $table = "konsultasi";
    protected $fillable = [
        'patients_id',
        'doctors_id',
    ] ;
     // Kolom-kolom yang akan otomatis di-cast sebagai instance Carbon
     protected $dates = ['tanggal_konsultasi'];
    public function pasien(){
        return $this->belongsTo(pasien::class, 'patient_id', 'id');
    }

    public function dokter(){
        return $this->belongsTo(dokter::class, 'doctor_id', 'id');
    }
    public function resep()
    {
        return $this->hasMany(Resep::class, 'konsultasi_id', 'id'); // Specify the foreign key in the Resep table
    }
public function obat()
{
    return $this->belongsTo(Obat::class);
}


}
