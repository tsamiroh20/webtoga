<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function faqumum()
    {
        $faqs = Faq::all(); // Mengambil semua FAQ dari database
        return view('faq', compact('faqs'));

    }

    public function faq()
    {
        $faqs = Faq::all(); // Mengambil semua FAQ dari database
        return view('user.faq', compact('faqs'));

    }

    public function adminfaq()
    {
        $faqs = Faq::all();
        return view('admin.faq.index', compact('faqs'));
    }

    public function faqsearch(Request $request)
    {
        // Ambil query pencarian dari input
        $query = $request->input('query');

        // Lakukan pencarian pada model Faq
        $faqs = Faq::where('pertanyaan', 'LIKE', "%{$query}%")
                    ->orWhere('jawaban', 'LIKE', "%{$query}%")
                    ->paginate(10);

        // Jika tidak ditemukan, berikan pesan notifikasi
        if ($faqs->isEmpty()) {
            return view('admin.faq.index', ['faqs' => $faqs, 'message' => 'FAQ yang dicari tidak ditemukan']);
        }

        // Kembalikan hasil pencarian ke view
        return view('admin.faq.index', ['faqs' => $faqs]);

    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
        ]);

        // Buat FAQ baru dengan data yang sudah divalidasi
        Faq::create([
            'pertanyaan' => $request->input('pertanyaan'),
            'jawaban' => $request->input('jawaban'),
        ]);

        // Redirect ke halaman index FAQ dengan pesan sukses
        return redirect()->route('admin/faq')->with('success', 'Data FAQ berhasil ditambahkan !!!');
    }

    public function show($id)
    {
        //mengambil data faq
        $faq = Faq::find($id); 

        //cek apakah faq ada atau tidak
        if (!$faq) {
            return redirect()->route('admin.faq.index')->with('error', 'FAQ tidak ditemukan');
        }

        return view('admin.faq.show', compact('faq'));
    }

    public function edit($id)
    {
        $faq = Faq::find($id);

        if (!$faq) {
            return redirect()->route('admin.faq.index')->with('error', 'FAQ tidak ditemukan');
        }

        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
        ]);

        // Temukan FAQ berdasarkan ID
        $faq = Faq::find($id);

        if (!$faq) {
            return redirect()->route('admin.faq')->with('error', 'FAQ tidak ditemukan');
        }

        // Update data FAQ
        $faq->pertanyaan = $request->input('pertanyaan');
        $faq->jawaban = $request->input('jawaban');
        $faq->save();

        // Redirect ke daftar FAQ dengan pesan sukses
        return redirect()->route('admin/faq')->with('success', 'Data FAQ berhasil diupdate');
    }

    // Method untuk menghapus FAQ
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin/faq')->with('success', 'Data FAQ berhasil dihapus');
    }

}
