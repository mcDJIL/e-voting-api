<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapresCawapres extends Model
{
    use HasFactory;

    protected $fillable = [
        'pasangan', 'partai', 'status_pemilu'
    ];

    
}
