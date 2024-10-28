<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{

    protected $fillable = [
        'tanaman_id', 
        'path'
    ];

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class);
    }
}
