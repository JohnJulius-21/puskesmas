<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_layanan extends Model
{
    use HasFactory;
    protected $table = 'jenis_layanan';

    public function pasien()
    {
        return $this->hasMany(pasien::class, 'id_dokter','id');
    }
}
