<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    protected $table = 'promo';
    protected $fillable =[
        'id',
        'kode_promo',
        'jenis_promo',
        'keterangan',
        'diskon',
        'status',

    ];

}
