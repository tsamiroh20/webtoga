<?php

namespace App\Http\Controllers;

use App\Models\Tanaman;
use App\Models\Vidio;
use Illuminate\Http\Request;

class VidioController extends Controller
{
    public function vidiouser($id)
    {
        // Mengambil tanaman spesifik berdasarkan id dengan video-nya
        $tanaman = Tanaman::with('vidios')->findOrFail($id);

        // Mengirimkan data ke view
        return view('user.vidio', compact('tanaman'));

    }

    public function vidio()
    {
        // Mengambil data vidio tanaman terkait
        $vidios = Vidio::with('tanaman')->get();

        return view('admin.vidio.vidio', compact('vidios'));
    }

    public function vidiosearch(Request $request)
    {
        // Ambil query pencarian dari input
        $query = $request->input('query');

        // Lakukan pencarian pada model Faq
        $vidios = Vidio::whereHas('tanaman', function($q) use ($query) {
                        $q->where('nama_latin', 'LIKE', "%{$query}%");
                        })->paginate(10);

        // Jika tidak ditemukan, berikan pesan notifikasi
        if ($vidios->isEmpty()) {
            return view('admin.vidio.vidio', [
                'vidios' => $vidios, 'message' => 'Data yang dicari tidak ditemukan'
            ]);
        }

        // Kembalikan hasil pencarian ke view
        return view('admin.vidio.vidio', ['vidios' => $vidios]);
    }

    public function create()
    {
        $tanamen = Tanaman::all();
        return view('admin.vidio.create', compact('tanamen'));
    }

    //menyimpan data baru
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'tanaman_id' => 'required|exists:tanamen,id',
            'video_url' => 'required|url',
        ], [
            'video_url.url' => 'Link yang dimasukkan harus berupa URL yang valid.',
        ]);

        // Menyimpan data baru ke database
        Vidio::create([
            'tanaman_id' => $request->input('tanaman_id'),
            'video_url' => $request->input('video_url'),
        ]);

        // Redirect ke halaman yang dituju dengan pesan sukses
        return redirect()->route('admin/vidio')->with('success', 'Data vidio berhasil ditambahkan !!!');
    }

    public function show($id)
    {
        $vidio = Vidio::with('tanaman')->findOrFail($id);
        return view('admin.vidio.show', compact('vidio'));
    }

    public function edit($id)
    {
        $vidio = Vidio::with('tanaman')->findOrFail($id);
        $tanamen = Tanaman::all();
        return view('admin.vidio.edit', compact('vidio', 'tanamen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanaman_id' => 'required|exists:tanamen,id',
            'video_url' => 'required|url',
        ], [
            'video_url.url' => 'Link yang dimasukkan harus berupa URL yang valid.',
        ]);

        $vidio = Vidio::findOrFail($id);
        $vidio->update([
            'tanaman_id' => $request->input('tanaman_id'),
            'video_url' => $request->input('video_url'),
        ]);

        return redirect()->route('admin/vidio')->with('success', 'Data vidio berhasil diperbarui !!!');
    }

    public function destroy($id)
    {
        $vidio = Vidio::findOrFail($id);
        $vidio->delete();

        return redirect()->route('admin/vidio')->with('delete_success', 'Data vidio berhasil dihapus !!!');
    }

}
