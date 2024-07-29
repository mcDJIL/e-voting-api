<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'email', 'password', 'umur', 'tanggal_lahir', 'provinsi_domisili', 'kota_domisili', 'id_provinsi', 'id_kota', 'token', 'isBan'
    ];

    protected $hidden = [
        'password'
    ];
}
