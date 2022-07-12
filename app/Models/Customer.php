<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Customer extends Authenticatable
{
    use HasFactory,HasApiTokens,Notifiable;
    protected $table = 'customer';


    protected $fillable = [
        'id_customer',
        'custom_id',
        'nama_customer',
        'no_ktp',
        'password',
        'alamat_customer',
        'tgl_lahir_customer',
        'gender_customer',
        'no_telp_customer',
        'email',
        'verifikasi_data',
        'status',
        'SIM',
        'KTP',
    ];
    protected $primaryKey = 'id_customer';
    protected $keyType = 'string';

    public function getCreatedAtAttribut(){
        if(!is_null($this->attributes['created_at'])){
            return Carbon::parse($this->attributes['created_at'])->format('Ym-d H:i:s');
        }
    }

    public function getUpdateAtAttribut(){
        if(!is_null($this->attributes['updated_at'])){
            return Carbon::parse($this->attributes['updated_at'])->format('Ym-d H:i:s');
        }
    }

    
    
}
