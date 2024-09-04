<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;
    protected $table = 'dokters';
    protected $fillable = ['name','spesialis','no_telp','status','foto'];

    public function pasien()
    {
        return $this->hasMany(pasien::class, 'id_dokter','id');
    }

    public function konsultasi(){
        return $this->hasMany(konsultasi::class);
    }
}
