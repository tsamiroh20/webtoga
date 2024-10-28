<?php

namespace App\Http\Controllers;

use App\Models\Tanggapan;
use Illuminate\Http\Request;

class TanggapanController extends Controller
{
    public function create()
    {
        $tanggapans = Tanggapan::all();
        return view('user.tanggapan', compact('tanggapans'));
    }

    //menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer',
            'kritik' => 'required|string',
            'saran' => 'required|string',
        ]);

        //menyimpan data baru ke database
        Tanggapan::create([
            'nama' => $request->nama,
            'umur' => $request->umur,
            'kritik' => $request->kritik,
            'saran' => $request->saran,
        ]);

        return redirect()->route('user.tanggapan')->with('success', 'Tanggapan berhasil terkirim !!!');
    } 

    public function tanggapanadmin()
    {
        //mengambil data dari tabel tanggapans dan mengurutkan data tersebut berdasarkan tanggal dibuatnya
        $tanggapans = Tanggapan::orderBy('created_at', 'DESC')->get();
        return view('admin.tanggapan.tanggapan', compact('tanggapans'));
    }

    public function tanggapansearch(Request $request)
    {
        // Ambil query pencarian dari input
        $query = $request->input('query');

        // Array untuk mengonversi nama bulan ke angka bulan
        $months = [
            'januari' => 1,
            'februari' => 2,
            'maret' => 3,
            'april' => 4,
            'mei' => 5,
            'juni' => 6,
            'juli' => 7,
            'agustus' => 8,
            'september' => 9,
            'oktober' => 10,
            'november' => 11,
            'desember' => 12
        ];

        // Ubah query menjadi huruf kecil untuk pencocokan
        $queryLower = strtolower($query);

        // Inisialisasi variabel untuk menyimpan bulan dalam angka
        $monthNumber = null;

        // Cek apakah query adalah nama bulan
        if (isset($months[$queryLower])) {
            $monthNumber = $months[$queryLower];
        }

        // Buat query builder
        $tanggapans = Tanggapan::query();

        // Filter berdasarkan tanggal lengkap jika query adalah format tanggal (Y-m-d)
        if (preg_match('/\d{4}-\d{2}-\d{2}/', $query)) {
            $tanggapans->whereDate('created_at', $query);
        }

        // Filter berdasarkan bulan jika nama bulan dikenali
        if ($monthNumber) {
            $tanggapans->orWhereMonth('created_at', $monthNumber);
        }

        // Filter berdasarkan tahun jika query adalah angka
        if (is_numeric($query) && strlen($query) == 4) {
            $tanggapans->orWhereYear('created_at', $query);
        }

        // Filter berdasarkan kritik dan saran
        $tanggapans->orWhere('kritik', 'LIKE', "%{$query}%")
        ->orWhere('saran', 'LIKE', "%{$query}%");

        // Dapatkan hasil dengan paginasi
        $tanggapans = $tanggapans->paginate(10);

        // Jika tidak ditemukan, berikan pesan notifikasi
        if ($tanggapans->isEmpty()) {
            return view('admin.tanggapan.tanggapan', ['tanggapans' => $tanggapans, 'message' => 'Data yang dicari tidak ditemukan']);
        }

        return view('admin.tanggapan.tanggapan', ['tanggapans' => $tanggapans]);

    }

    public function show(string $id)
    {
        $tanggapan = Tanggapan::findOrFail($id);

        return view('admin.tanggapan.show', compact('tanggapan'));
    }

    public function destroy($id)
    {
        $tanggapan = Tanggapan::findOrFail($id);
        $tanggapan->delete();

        return redirect()->route('admin/tanggapan')->with('success', 'Data tanggapan berhasil dihapus');
    }
}
