<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemiluPresiden extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 'provinsi_domisili', 'kota_domisili', 'pilihan'
    ];
}
