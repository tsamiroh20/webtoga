<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyajian extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanaman_id', 
        'nama_penyakit',
        'cara_penyajian'
    ];

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class, 'tanaman_id');
    }
}
