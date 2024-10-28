<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TanamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function tanamanumum()
    {
        $tanamans = Tanaman::orderBy('created_at', 'DESC')->paginate(5); // Mengurutkan data secara DESC dan menampilkan per halaman
        return view('tanaman', compact('tanamans'));
    }

    // Metode pencarian tanaman
    public function searchtanaman(Request $request)
    {
        // Ambil query pencarian dari input 
        $query = $request->input('query');

        // Lakukan pencarian pada model Tanaman
        $tanamans = Tanaman::where('nama_latin', 'LIKE', "%{$query}%")
                            ->orWhere('nama_ilmiah', 'LIKE', "%{$query}%")
                            ->paginate(10);
 
        // Jika hasil pencarian kosong, kirim pesan
        if ($tanamans->isEmpty()) {
        return view('tanaman', ['tanamans' => $tanamans, 'message' => 'Data tanaman yang dicari tidak ditemukan']);
        }

        // Kembalikan hasil pencarian ke view
        return view('tanaman', ['tanamans' => $tanamans]);
    } 

    public function tanamanuser()
    {
        $tanamans = Tanaman::orderBy('created_at', 'DESC')->paginate(5); // Mengurutkan data secara DESC dan menampilkan per halaman
        return view('user.tanaman', compact('tanamans'));
    }

    // Metode pencarian tanaman
    public function tanamansearch(Request $request)
    {
        // Ambil query pencarian dari input
        $query = $request->input('query');

        // Lakukan pencarian pada model Tanaman
        $tanamans = Tanaman::where('nama_latin', 'LIKE', "%{$query}%")
                            ->orWhere('nama_ilmiah', 'LIKE', "%{$query}%")
                            ->paginate(10);

        // Jika hasil pencarian kosong, kirim pesan
        if ($tanamans->isEmpty()) {
        return view('user.tanaman', ['tanamans' => $tanamans, 'message' => 'Data tanaman yang dicari tidak ditemukan']);
        }

        // Kembalikan hasil pencarian ke view
        return view('user.tanaman', ['tanamans' => $tanamans]);
    }

     public function toga()
    {
        $tanaman = Tanaman::orderBy('id', 'desc')->get(); // Mengambil data tanaman dengan urutan descending (terbaru ke terlama) berdasarkan id 
        return view('admin.tanaman.toga',compact('tanaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tanaman.create');
    }

    // Method untuk menyimpan data tanaman baru
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nama_latin' => 'required|string|max:255',
            'nama_ilmiah' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'khasiat' => 'required|string',
            'dosis' => 'required|string',
            'kandungan_zat' => 'required|string',
            'perhatian' => 'required|string',
            'cara_budidaya' => 'required|string',
            'foto_tanaman' => 'required|array',
            'foto_tanaman.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Simpan data tanaman
        $tanaman = Tanaman::create($validatedData);

        // Simpan foto-foto
        if ($request->hasFile('foto_tanaman')) {
            foreach ($request->file('foto_tanaman') as $file) {
                $path = $file->store('fotos', 'public');
                Foto::create([
                    'tanaman_id' => $tanaman->id,
                    'path' => $path,
                ]);
            }
        } 

        return redirect()->route('admin/tanaman')->with('success', 'Data Tanaman Berhasil ditambahkan !!!');
    }

    public function show(string $id)
    {
        $tanaman = Tanaman::with('fotos')->findOrFail($id); // Mengambil tanaman beserta foto-fotonya

        return view('admin.tanaman.show', compact('tanaman'));
        
    }

    public function edit(string $id)
    {
        $tanaman = Tanaman::findOrFail($id);
 
        return view('admin.tanaman.edit', compact('tanaman'));
    }


    public function update(Request $request, $id)
    {
         // Validasi data
         $validatedData = $request->validate([
            'nama_latin' => 'required|string|max:255',
            'nama_ilmiah' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'khasiat' => 'required|string',
            'dosis' => 'required|string',
            'kandungan_zat' => 'required|string',
            'perhatian' => 'required|string',
            'cara_budidaya' => 'required|string',
            'foto_tanaman' => 'array',
            'foto_tanaman.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $tanaman = Tanaman::findOrFail($id);
        $tanaman->update($validatedData);

        // Proses penghapusan foto
        if($request->has('delete_foto')) {
            foreach($request->delete_foto as $fotoId) {
                $foto = Foto::findOrFail($fotoId);
                Storage::delete('public/' . $foto->path); // Hapus file dari storage
                $foto->delete(); // Hapus record dari database
            }
        }

        // Proses upload foto baru
        if($request->hasFile('foto_tanaman')) {
            foreach($request->file('foto_tanaman') as $file) {
                $path = $file->store('tanaman', 'public');
                $tanaman->fotos()->create(['path' => $path]);
            }
        }
    
        return redirect()->route('admin/tanaman')->with('success', 'Data Tanaman Berhasil diupdate');
    }

    public function destroy(string $id)
    {
        // Temukan data tanaman berdasarkan ID
        $tanaman = Tanaman::findOrFail($id);

        // Hapus foto-foto terkait
        foreach ($tanaman->fotos as $foto) {
            Storage::disk('public')->delete($foto->path);
            $foto->delete();
        }

        // Hapus data tanaman
        $tanaman->delete();

    return redirect()->route('admin/tanaman')->with('success', 'Data Tanaman Berhasil Dihapus');
    }
}
