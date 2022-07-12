<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';

    protected $fillable = [
        'id_transaksi',
        'tgl_transaksi',
        'tgl_mulai',
        'tgl_selesai',
        'tgl_pengembalian',
        'biaya',
        'denda',
        'rating',
        'metode_pembayaran',
        'bukti_pembayaran',
        'jenis_transaksi',
        'verifikasi_pembayaran',
        'verifikasi_dokumen',
        'id_customer',
        'id_aset',
        'id_promo',
        'id_pegawai',
        'id_driver',
    ];
    protected $primaryKey = 'id_transaksi';
    protected $keyType = 'string';

   
}
