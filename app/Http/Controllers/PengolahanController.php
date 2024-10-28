<?php

namespace App\Http\Controllers;

use App\Models\Penyajian;
use App\Models\Tanaman;
use Illuminate\Http\Request;

class PengolahanController extends Controller
{

    public function penyajianuser($id)
    {
        // Pastikan bahwa mencari tanaman berdasarkan id yang diberikan
        $tanamans = Tanaman::with('fotos', 'penyajians')->find($id);

        // Periksa apakah tanaman ditemukan
        if (!$tanamans) {
            return redirect()->back()->with('error', 'Tanaman tidak ditemukan');
        }
        return view('user.penyajian', compact('tanamans'));
    }

    public function penyajian()
    {
        // Mengambil data penyajian beserta nama latin dari tanaman terkait
        $penyajians = Penyajian::with('tanaman')->get();

        return view('admin.penyajian.penyajian', compact('penyajians'));
    } 

    public function penyajiansearch(Request $request)
    {
        // Ambil query pencarian dari input
        $query = $request->input('query');

        // Lakukan pencarian pada model Faq
        $penyajians = Penyajian::where('nama_penyakit', 'LIKE', "%{$query}%")
                    ->orWhereHas('tanaman', function($q) use ($query) {
                        $q->where('nama_latin', 'LIKE', "%{$query}%"); })
                    ->paginate(10);

        // Jika tidak ditemukan, berikan pesan notifikasi
        if ($penyajians->isEmpty()) {
            return view('admin.penyajian.penyajian', ['penyajians' => $penyajians, 'message' => 'Data yang dicari tidak ditemukan']);
        }

        // Kembalikan hasil pencarian ke view
        return view('admin.penyajian.penyajian', ['penyajians' => $penyajians]);
    }

    public function create()
    {
        $tanamen = Tanaman::all();
        return view('admin.penyajian.create', compact('tanamen'));
    }

    //menyimpan data baru
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'tanaman_id' => 'required|exists:tanamen,id',
            'nama_penyakit' => 'required',
            'cara_penyajian' => 'required',
        ]);
        
        //menyimpan data baru ke database
        Penyajian::create([
            'tanaman_id' => $request->input('tanaman_id'),
            'nama_penyakit' => $request->input('nama_penyakit'),
            'cara_penyajian' => $request->input('cara_penyajian'),
        ]);

        // Redirect ke halaman yang dituju dengan pesan sukses
        return redirect()->route('admin/penyajian')->with('success', 'Data penyajian berhasil ditambahkan !!!');
    }

    public function show($id)
    {
        $penyajian = Penyajian::find($id);

        if (!$penyajian) {
            return redirect()->route('admin.penyajian.penyajian')->with('error', 'Data tidak ditemukan');
        }

        return view('admin.penyajian.show', compact('penyajian'));
    }

    public function edit($id)
    {
        $penyajian = Penyajian::find($id);

        if (!$penyajian) {
            return redirect()->route('admin.penyajian.penyajian')->with('error', 'Penyajian tidak ditemukan');
        }

        return view('admin.penyajian.edit', compact('penyajian'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_penyakit' => 'required|string|max:255',
            'cara_penyajian' => 'required|string',
        ]);

        // Temukanberdasarkan ID
        $penyajian = Penyajian::find($id);

        if (!$penyajian) {
            return redirect()->route('admin.penyajian')->with('error', 'Data penyajian tidak ditemukan');
        }

        // Update data 
        $penyajian->nama_penyakit = $request->input('nama_penyakit');
        $penyajian->cara_penyajian = $request->input('cara_penyajian');
        $penyajian->save();

        return redirect()->route('admin/penyajian')->with('success', 'Data penyajian berhasil diupdate');
    }

    public function destroy($id)
    {
        $penyajian = Penyajian::findOrFail($id);
        $penyajian->delete();

        return redirect()->route('admin/penyajian')->with('success', 'Data penyajian berhasil dihapus');
    }
}
