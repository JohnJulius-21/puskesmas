<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obat extends Model
{
    use HasFactory;
    protected $table = "obat";
    protected $primaryKey = "id";
    protected $fillable = 
    [
        "nama_obat",
        "satuan_terkecil",
        "status",
        
    ];
    public $timestamps = true;
}
