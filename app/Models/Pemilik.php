<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;
    protected $table = 'pemilik_aset';

    protected $fillable = [
        'id',
        'nama',
        'no_ktp',
        'alamat',
        'no_telp',
        'waktu_kontrak',
        'mulai_kontrak',
        'selesai_kontrak',
    ];
}
