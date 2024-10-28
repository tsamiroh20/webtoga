<?php

namespace App\Http\Controllers;

use App\Models\Tanaman;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Metode pencarian tanaman homeuser
    public function search(Request $request) 
    { 
        // Ambil query pencarian dari input
        $query = $request->input('query'); 

        // Lakukan pencarian pada model Tanaman dengan join ke Penyajian untuk nama penyakit
        $tanamans = Tanaman::join('penyajians', 'tanamen.id', '=', 'penyajians.tanaman_id')
                            ->where('tanamen.nama_latin', 'LIKE', "%{$query}%")
                            ->orWhere('tanamen.nama_ilmiah', 'LIKE', "%{$query}%")
                            ->orWhere('tanamen.kandungan_zat', 'LIKE', "%{$query}%")
                            ->orWhere('penyajians.nama_penyakit', 'LIKE', "%{$query}%")
                            ->select('tanamen.*') // Memilih hanya kolom dari tabel tanamans
                            ->distinct() // Menghilangkan duplikat jika ada
                            ->paginate(10);

        // Jika hasil pencarian kosong, kirim pesan
        if ($tanamans->isEmpty()) {
            return view('user.detailsearchuser', ['tanamans' => $tanamans, 'message' => 'Data tanaman yang dicari tidak ditemukan']);
        }

        // Kembalikan hasil pencarian ke view
        return view('user.detailsearchuser',['tanamans' => $tanamans]);
    }

}
