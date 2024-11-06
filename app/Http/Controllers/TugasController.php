<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\PengumpulanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::where('pengajar_id', auth()->id())->paginate(5);
        return view('pengajar.tugas.index', compact('tugas'));
    }

    public function create()
    {
        return view('pengajar.tugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'batas_waktu' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:50000',
        ]);

        $tugas = new Tugas();
        $tugas->judul = $request->judul;
        $tugas->deskripsi = $request->deskripsi;
        $tugas->batas_waktu = $request->batas_waktu;
        $tugas->pengajar_id = auth()->user()->id;

        if ($request->hasFile('file')) {
            $tugas->file = $request->file('file')->store('tugas_files', 'public');
        }

        $tugas->save();

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function show($id)
    {
        $tugas = Tugas::findOrFail($id);
        $pengajar = $tugas->pengajar; // Asumsikan ada relasi pengajar pada model Tugas
        $mapel = $pengajar->mapels->first(); // Pastikan relasi 'mapels' sudah terdefinisi di model Pengajar
        return view('pengajar.tugas.show', compact('tugas', 'pengajar', 'mapel'));
    }

    public function edit($id)
    {
        $tugas = Tugas::findOrFail($id);
        return view('pengajar.tugas.edit', compact('tugas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'batas_waktu' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $tugas = Tugas::findOrFail($id);
        $tugas->judul = $request->judul;
        $tugas->deskripsi = $request->deskripsi;
        $tugas->batas_waktu = $request->batas_waktu;

        if ($request->hasFile('file')) {
            if ($tugas->file) {
                Storage::delete($tugas->file);
            }
            $tugas->file = $request->file('file')->store('tugas_files', 'public');
        }

        $tugas->save();

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);
        if ($tugas->file) {
            Storage::delete($tugas->file);
        }
        $tugas->delete();

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil dihapus.');
    }

    public function showKirimTugasForm($id)
    {
        $tugas = Tugas::find($id);

        if (!$tugas) {
            return redirect()->route('murid.tugas.index')->with('error', 'Tugas tidak ditemukan.');
        }

        return view('murid.kirim-tugas', compact('tugas'));
    }

    public function kirimTugas(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|mimes:png,jpg,mp4,doc,docx,pdf|max:1000000',
            'catatan' => 'nullable|string|max:500',
        ]);
    
        $tugas = Tugas::findOrFail($id);
    
        // Dapatkan nama file asli dan simpan ke direktori `public/pengumpulan_tugas`
        $fileName = $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('public/pengumpulan_tugas', $fileName);
    
        // Simpan data ke tabel pengumpulan_tugas dengan hanya nama file
        PengumpulanTugas::create([
            'user_id' => auth()->id(),
            'tugas_id' => $tugas->id,
            'file' => $fileName, // Hanya simpan nama file di database
            'catatan' => $request->input('catatan'),
        ]);
    
        return redirect()->route('murid.murid-dashboard')->with('success', 'Tugas berhasil dikirim!');
    }    
}