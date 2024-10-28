<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'umur',
        'kritik', 
        'saran'
    ];

    public $timestamps = true; // Menggunakan timestamps
}
