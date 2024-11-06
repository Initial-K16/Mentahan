<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Tugas;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UploadController extends Controller
{
    public function index()
    {
        // Ambil daftar materi dan tugas dengan kelas terkait yang diunggah oleh pengajar yang sedang login
        $materis = Materi::with('kelas')->where('pengajar_id', auth()->id())->get();
        $tugas = Tugas::with('kelas')->where('pengajar_id', auth()->id())->get();

        // Gabungkan materi dan tugas ke satu collection
        $uploads = $materis->merge($tugas);

        // Urutkan data berdasarkan waktu upload (created_at)
        $uploads = $uploads->sortByDesc('created_at');

        // Tentukan jumlah item per halaman
        $perPage = 5;

        // Ambil halaman saat ini dari request, default 1
        $currentPage = LengthAwarePaginator::resolveCurrentPage() ?? 1;

        // Slice (potong) koleksi sesuai dengan halaman yang diminta
        $currentItems = $uploads->slice(($currentPage - 1) * $perPage, $perPage)->all();

        // Buat instance paginator
        $paginatedUploads = new LengthAwarePaginator($currentItems, $uploads->count(), $perPage, $currentPage, [
            'path' => request()->url(), // Gunakan URL saat ini
            'query' => request()->query(), // Pertahankan query string dari request
        ]);

        return view('pengajar.upload.index', compact('paginatedUploads'));
    }

    public function create()
    {
        // Ambil semua materi, tugas, dan kelas yang tersedia
        $materis = Materi::where('pengajar_id', auth()->id())->get();
        $tugas = Tugas::where('pengajar_id', auth()->id())->get();
        $kelas = Kelas::all();

        return view('pengajar.upload.create', compact('materis', 'tugas', 'kelas'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'type' => 'required', // Materi atau tugas
            'content_id' => 'required', // ID materi atau tugas
            'kelas_id' => 'required', // Kelas yang dipilih
        ]);

        [$type, $id] = explode('-', $request->content_id);

        if ($type === 'materi') {
            $materi = Materi::find($id);
            $materi->kelas()->attach($request->kelas_id);
        } else {
            $tugas = Tugas::find($id);
            $tugas->kelas()->attach($request->kelas_id);
        }

        return redirect()->route('upload.index')->with('success', 'Materi/Tugas berhasil di-upload ke kelas.');
    }

        public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'content_id' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        if ($request->type == 'materi') {
            $materiId = str_replace('materi-', '', $request->content_id);
            $materi = Materi::findOrFail($materiId);

            // Menggunakan attach dengan timestamps
            $materi->kelas()->attach($request->kelas_id, ['created_at' => now(), 'updated_at' => now()]);
        } else if ($request->type == 'tugas') {
            $tugasId = str_replace('tugas-', '', $request->content_id);
            $tugas = Tugas::findOrFail($tugasId);

            // Menggunakan attach dengan timestamps
            $tugas->kelas()->attach($request->kelas_id, ['created_at' => now(), 'updated_at' => now()]);
        }

        return redirect()->route('upload.index')->with('success', 'Materi/Tugas berhasil di-upload ke kelas.');
    }
}
