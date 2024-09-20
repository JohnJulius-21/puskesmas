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
    ];

    public function pasien(){
        return $this->belongsTo(pasien::class, 'patient_id', 'id');
    }

    public function obat(){
        return $this->belongsTo(obat::class, 'obat_id', 'id');
    }
}
