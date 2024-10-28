<?php

namespace App\Http\Controllers;

use App\Models\Tanaman;
use Illuminate\Http\Request;

class KhasiatController extends Controller
{
    public function khasiatumum($id)
    {
        // Pastikan bahwa kita mencari tanaman berdasarkan id yang diberikan
        $tanamans = Tanaman::with('fotos')->find($id);

        // Periksa apakah tanaman ditemukan
        if (!$tanamans) {
            return redirect()->back()->with('error', 'Tanaman tidak ditemukan');
        }
            
        return view('khasiat', compact('tanamans'));
    }

    public function khasiatuser($id)
    {
        // Pastikan bahwa kita mencari tanaman berdasarkan id yang diberikan
        $tanamans = Tanaman::with('fotos')->find($id);

        // Periksa apakah tanaman ditemukan
        if (!$tanamans) {
            return redirect()->back()->with('error', 'Tanaman tidak ditemukan');
        }
            
        return view('user.khasiat', compact('tanamans'));
    }
}
