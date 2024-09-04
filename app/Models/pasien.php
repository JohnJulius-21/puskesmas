<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pasien extends Model
{
    use HasFactory;
    protected $table = 'pasien';

    public function jenis_layanan(){
        return $this->belongsTo(jenis_layanan::class, 'id_jenis_layanan', 'id');
    }

    public function dokter(){
        return $this->belongsTo(dokter::class, 'id_dokter', 'id');
    }

    public function konsultasi(){
        return $this->hasMany(konsultasi::class);
    }
}
