<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Driver extends Authenticatable
{
    use HasFactory,HasApiTokens,Notifiable;
    protected $table = 'driver';

    protected $fillable = [
        'id_driver',
        'custom_id',
        'nama',
        'alamat',
        'tgl_lahir',
        'gender',
        'no_telp',
        'email',
        'password',
        'bahasa',
        'foto',
        'sim',
        'napza',
        'jiwa',
        'jasmani',
        'skck',
        'status',
    ];
    protected $primaryKey = 'id_driver';
    protected $keyType = 'string';
}
