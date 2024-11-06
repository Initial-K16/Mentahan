<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada

class MateriController extends Controller
{
    public function index()
    {
        // Ambil data kelas dengan pagination, batasi 5 data per halaman
        $materis = Materi::where('pengajar_id', auth()->id())->paginate(5);

        return view('pengajar.materi.index', compact('materis'));
    }

    public function create()
    {
        return view('pengajar.materi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'url' => 'nullable|url',
        ]);

        $materi = new Materi();
        $materi->judul = $request->judul;
        $materi->deskripsi = $request->deskripsi;

        // Menyimpan ID pengajar yang sedang login
        $materi->pengajar_id = auth()->user()->id;

        // Menyimpan file jika ada
        if ($request->hasFile('file')) {
            $materi->file = $request->file('file')->store('materi_files', 'public');
        }

        // Menyimpan URL jika ada
        if ($request->filled('url')) {
            $materi->url = $request->url;
        }

        // Simpan materi ke database
        if ($materi->save()) {
            return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan materi. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        $materi = Materi::findOrFail($id);
        return view('pengajar.materi.edit', compact('materi')); // Pastikan path view sesuai
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:50000',
            'url' => 'nullable|url', // Validasi URL
        ]);

        $materi = Materi::findOrFail($id);
        $materi->judul = $request->judul;
        $materi->deskripsi = $request->deskripsi;

        // Cek jika ada file yang diupload
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($materi->file) {
                \Storage::delete($materi->file);
            }
            $materi->file = $request->file('file')->store('materi_files', 'public');
        }

        // Simpan URL baru jika ada
        if ($request->filled('url')) {
            $materi->url = $request->url;
        }

        // Simpan materi yang diperbarui
        $materi->save();

        return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

        public function show($id)
    {
        $materi = Materi::findOrFail($id);
        $pengajar = $materi->pengajar; // Ambil pengajar dari materi
        $mapel = $pengajar->mapels->first(); // Ambil mata pelajaran pertama yang sesuai dengan pengajar
    
        return view('pengajar.materi.show', compact('materi', 'mapel'));
    }

    public function pengajar()
    {
        return $this->belongsTo(User::class, 'pengajar_id');
    }

    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        
        // Hapus file jika ada
        if ($materi->file) {
            Storage::delete($materi->file);
        }

        $materi->delete();
        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}