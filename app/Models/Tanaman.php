<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_latin', 
        'nama_ilmiah', 
        'deskripsi', 
        'khasiat', 
        'kandungan_zat',
        'dosis', 
        'perhatian', 
        'cara_budidaya'
    ];

    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }

    public function referensi()
    {
        return $this->hasMany(Referensi::class, 'tanaman_id');
    }

    public function penyajians()
    {
        return $this->hasMany(Penyajian::class, 'tanaman_id');
    }

    public function vidios()
    {
        return $this->hasMany(Vidio::class, 'tanaman_id');
    }
}

