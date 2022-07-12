<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;
    protected $table = 'aset';

    protected $fillable = [
        'id',
        'nama_mobil',
        'plat_nomor',
        'stnk',
        'kategory',
        'kapasitas',
        'tipe',
        'transmisi',
        'bahanBakar',
        'volume',
        'warna',
        'harga',
        'status',
        'id_pemilik',
        'id_brosur',
        'fasilitas',
    ];
}
