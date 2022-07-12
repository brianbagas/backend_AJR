<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_jadwal extends Model
{
    use HasFactory;
    protected $table = 'detail_jadwal';

    protected $fillable = [
        'keterangan',
        'id_jadwal',
        'id_pegawai',
    ];
    protected $primaryKey = 'id_customer';
    protected $keyType = 'string';
}
