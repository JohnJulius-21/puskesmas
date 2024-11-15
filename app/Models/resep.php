<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resep extends Model
{
    use HasFactory;

    protected $table = 'resep';
    protected $primaryKey = 'id';

    protected $fillable = [
        'pasien', // Perbaiki di sini
        'obat',    // Perbaiki di sini
        'laporan',
        'catatan',
        'konsultasi_id'
       
    ];

    public function pasien(){
        return $this->belongsTo(pasien::class, 'patient_id', 'id');
    }

    public function obat(){
        return $this->belongsTo(obat::class, 'obat_id', 'id');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id', 'id');
    }
    public function konsultasi()
    {
        return $this->belongsTo(konsultasi::class, 'konsultasi_id', 'id'); // Specify the foreign key and local key
    }

    // Define the relationship with the Obat model
    
//     public function resep()
// {
//     return $this->hasMany(resep::class, 'konsultasi_id', 'id'); // Specify the foreign key and local key
// }


}
