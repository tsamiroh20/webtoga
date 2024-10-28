<?php

namespace App\Http\Controllers;

use App\Models\Tanaman;
use Illuminate\Http\Request;

class BudidayaController extends Controller
{
    public function budidayatanaman()
    { 
        $tanamans = Tanaman::paginate(9); // Menampilkan jumlah data per halaman
        return view('user.budidaya', compact('tanamans'));
    }

    // Metode pencarian
    public function budidayasearch(Request $request)
    {
        // Ambil query pencarian dari input
        $query = $request->input('query');

        // Lakukan pencarian pada model Tanaman
        $tanamans = Tanaman::where('nama_latin', 'LIKE', "%{$query}%")
                            ->orWhere('nama_ilmiah', 'LIKE', "%{$query}%")
                            ->paginate(10);

        // Jika hasil pencarian kosong, kirim pesan
        if ($tanamans->isEmpty()) {
        return view('user.budidaya', ['tanamans' => $tanamans, 'message' => 'Tanaman yang dicari tidak ditemukan']);
        }

        // Kembalikan hasil pencarian ke view
        return view('user.budidaya', ['tanamans' => $tanamans]);
    }
}
