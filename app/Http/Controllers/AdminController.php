<?php

namespace App\Http\Controllers;

use App\Models\Tanaman;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function datasearch(Request $request)
    {
        // Ambil query pencarian dari input
        $query = $request->input('query');

        // Lakukan pencarian pada model Tanaman
        $tanaman = Tanaman::where('nama_latin', 'LIKE', "%{$query}%")
                            ->orWhere('nama_ilmiah', 'LIKE', "%{$query}%")
                            ->paginate(10); 

        if ($tanaman->isEmpty()) {
            return view('admin.tanaman.toga', ['tanaman' => $tanaman, 'message' => 'Tanaman yang dicari tidak ditemukan']);
        }

        return view('admin.tanaman.toga', ['tanaman' => $tanaman]);
    }
}
