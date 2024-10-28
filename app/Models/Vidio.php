<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vidio extends Model
{
    use HasFactory;

    // Menentukan kolom yang bisa diisi (fillable)
    protected $fillable = ['tanaman_id', 'video_url'];

    // Relasi dengan model Tanaman (many-to-one)
    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class);
    }
}
