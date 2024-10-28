<?php

namespace App\Http\Controllers;

use App\Models\Referensi;
use App\Models\Tanaman;
use Illuminate\Http\Request;

class ReferensiController extends Controller
{
    public function aboutumum()
    {
        return view('about');
    }

    public function referensiumum()
    {
        //mencari data dari tabel referensi dan relasi data dengan tanaman
        $referensis = Referensi::with('tanaman')->get();

        return view('referensi', compact('referensis'));
    }

    public function referensisearchumum(Request $request)
    {
        // Ambil query pencarian dari input
        $query = $request->input('query');

        // Lakukan pencarian pada model Referensi yang berelasi dengan Tanaman
        $referensis = Referensi::whereHas('tanaman', function ($q) use ($query) {
                                $q->where('nama_latin', 'LIKE', "%{$query}%");
                                })->paginate(10);

        // Jika hasil pencarian kosong, kirim pesan
        if ($referensis->isEmpty()) {
            return view('referensi', ['referensis' => $referensis, 'message' => 'Tanaman yang dicari tidak ditemukan']);
        }

        // Kembalikan hasil pencarian ke view
        return view('referensi', ['referensis' => $referensis]);
    }

    public function about()
    {
        return view('user.about');
    }

    public function referensi()
    {
        $referensis = Referensi::with('tanaman')->get();

        return view('user.referensi', compact('referensis'));
    }

    // Metode pencarian
    public function userreferensisearch(Request $request)
    {
        // Ambil query pencarian dari input
        $query = $request->input('query');

        // Lakukan pencarian pada model Referensi yang berelasi dengan Tanaman
        $referensis = Referensi::whereHas('tanaman', function ($q) use ($query) {
                                $q->where('nama_latin', 'LIKE', "%{$query}%");
                                })->paginate(10);

        // Jika hasil pencarian kosong, kirim pesan
        if ($referensis->isEmpty()) {
            return view('user.referensi', ['referensis' => $referensis, 'message' => 'Tanaman yang dicari tidak ditemukan']);
        }

        // Kembalikan hasil pencarian ke view
        return view('user.referensi', ['referensis' => $referensis]);
    }

    public function adminreferensi()
    {
        // Mengambil data referensi beserta nama latin dari tanaman terkait
        $referensis = Referensi::with('tanaman')->get();

        return view('admin.referensi.referensi', compact('referensis'));
    }

    public function referensisearch(Request $request)
    {
        // Ambil query pencarian dari input
        $query = $request->input('query');

        // Lakukan pencarian pada model Faq
        $referensis = Referensi::where('referensi', 'LIKE', "%{$query}%")
                    ->orWhereHas('tanaman', function($q) use ($query) {
                        $q->where('nama_latin', 'LIKE', "%{$query}%"); })
                    ->paginate(10);

        // Jika tidak ditemukan, berikan pesan notifikasi
        if ($referensis->isEmpty()) {
            return view('admin.referensi.referensi', ['referensis' => $referensis, 'message' => 'Data referensi yang dicari tidak ditemukan']);
        }

        // Kembalikan hasil pencarian ke view
        return view('admin.referensi.referensi', ['referensis' => $referensis]);
    }

    public function create()
    {
        $tanamen = Tanaman::all();
        return view('admin.referensi.create', compact('tanamen'));
    }

    //menyimpan data baru
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'tanaman_id' => 'required|exists:tanamen,id',
            'referensi' => 'required',
            'pustaka' => 'required',
        ]);
        
        //menyimpan data baru ke database
        Referensi::create([
            'tanaman_id' => $request->input('tanaman_id'),
            'referensi' => $request->input('referensi'),
            'pustaka' => $request->input('pustaka'),
        ]);

        // Redirect ke halaman yang dituju dengan pesan sukses
        return redirect()->route('admin/referensi')->with('success', 'Data referensi berhasil ditambahkan !!!');
    }

    public function show($id)
    {
        $referensi = Referensi::find($id);

        if (!$referensi) {
            return redirect()->route('admin.referensi.referensi')->with('error', 'Data tidak ditemukan');
        }

        return view('admin.referensi.show', compact('referensi'));
    }

    public function edit($id)
    {
        $referensi = Referensi::find($id);

        if (!$referensi) {
            return redirect()->route('admin.freferensi.referensi')->with('error', 'Referensi tidak ditemukan');
        }

        return view('admin.referensi.edit', compact('referensi'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'referensi' => 'required|string|max:255',
            'pustaka' => 'required|string',
        ]);

        // Temukanberdasarkan ID
        $referensi = Referensi::find($id);

        if (!$referensi) {
            return redirect()->route('admin.referensi')->with('error', 'Referensi tidak ditemukan');
        }

        // Update data 
        $referensi->referensi = $request->input('referensi');
        $referensi->pustaka = $request->input('pustaka');
        $referensi->save();

        return redirect()->route('admin/referensi')->with('success', 'Data Referensi berhasil diupdate');
    }

    // Method untuk menghapus FAQ
    public function destroy($id)
    {
        $referensi = Referensi::findOrFail($id);
        $referensi->delete();

        return redirect()->route('admin/referensi')->with('success', 'Data Referensi berhasil dihapus');
    }
    
}
