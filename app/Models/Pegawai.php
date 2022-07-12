<?php

namespace App\Models;

use Carbon\Carbon;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pegawai extends Authenticatable
{
    use HasFactory,HasApiTokens,Notifiable;
    protected $table = 'pegawai';

    protected $fillable = [
        'id_pegawai',
        'custom_id',
        'nama',
        'alamat',
        'tgl_lahir',
        'gender',
        'no_telp',
        'email',
        'password',
        'foto',
        'id_role',
        'status',
    ];
    protected $primaryKey = 'id_pegawai';
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
