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

    public function pasien(){
        return $this->belongsTo(pasien::class, 'patient_id', 'id');
    }

    public function dokter(){
        return $this->belongsTo(dokter::class, 'doctor_id', 'id');
    }
}
