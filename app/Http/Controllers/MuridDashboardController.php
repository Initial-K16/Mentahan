<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\Materi;
use Illuminate\Http\Request;
use App\Models\PengumpulanTugas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MuridDashboardController extends Controller
{
        public function index()
    {
        $user = Auth::user();
        $userId = Auth::id();

        // Ambil kelas yang dipilih oleh murid
        $kelasUser = $user->kelas()->first();

        // Ambil jurusan dan nama kelas
        $jurusanKelas = $kelasUser ? $kelasUser->jurusan : null;
        $namaKelas = $kelasUser ? $kelasUser->nama_kelas : null;

        // Ambil daftar murid yang terdaftar di kelas yang sama
        $daftarMurid = $kelasUser ? $kelasUser->users()->get() : collect();

        // Ambil materi yang terkait dengan kelas
        $materis = $kelasUser ? $kelasUser->materis : collect();

        // Ambil tugas yang terkait dengan kelas melalui tabel kelas_tugas
        $tugas = Tugas::whereHas('kelas', function ($query) use ($kelasUser) {
            $query->where('kelas.id', $kelasUser->id);
        })
        ->whereDoesntHave('pengumpulanTugas', function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('tugas_dikonfirmasi', 1);
        })
        ->get();

        // Ambil tugas yang telah dikonfirmasi
        $tugasDikonfirmasi = PengumpulanTugas::where('user_id', $userId)
        ->where('tugas_dikonfirmasi', 1) // 1 untuk dikonfirmasi
        ->join('tugas', 'pengumpulan_tugas.tugas_id', '=', 'tugas.id')
        ->with('pengajar') // Menambahkan eager loading
        ->select('tugas.*')
        ->get();

        // Pisahkan materi menjadi terbaru (7 hari terakhir) dan lainnya
        $materiTerbaru = $materis->filter(function ($materi) {
            return $materi->created_at >= Carbon::now()->subDays(7);
        });
        $materiLainnya = $materis->filter(function ($materi) {
            return $materi->created_at < Carbon::now()->subDays(7);
        });

        return view('murid.murid-dashboard', compact(
            'tugas',
            'tugasDikonfirmasi', // Pastikan variabel ini juga diteruskan
            'jurusanKelas',
            'namaKelas',
            'daftarMurid',
            'materis',
            'materiTerbaru',
            'materiLainnya'
        ));
    }

    public function daftar()
    {
        $user = Auth::user();
        $kelasUser = $user->kelas()->first();
        $daftarMurid = $kelasUser ? $kelasUser->users()->get() : collect();

        return view('murid.daftar-murid', compact('daftarMurid'));
    }

    public function lihatMateri($id)
    {
        $materi = Materi::findOrFail($id);
        $pengajar = $materi->pengajar; // Ambil pengajar dari materi
        $mapel = $pengajar->mapels->first(); // Ambil mata pelajaran pertama yang sesuai dengan pengajar

        return view('murid.lihat-materi', compact('materi', 'mapel'));
    }

    public function lihatTugas($id)
    {
        $userId = auth()->user()->id;
        $tugas = Tugas::findOrFail($id);
        $pengajar = $tugas->pengajar; // Asumsikan ada relasi pengajar pada model Tugas
        $mapel = $pengajar->mapels->first(); // Pastikan relasi 'mapels' sudah terdefinisi di model Pengajar
       

        // Cek apakah siswa sudah mengirim tugas
        $pengumpulan = PengumpulanTugas::where('tugas_id', $tugas->id)
        ->where('user_id', $userId)
        ->first();
        return view('murid.lihat-tugas', compact('tugas', 'pengajar', 'mapel', 'pengumpulan'));
    }

    public function editTugas($id)
    {
        // Ambil pengumpulan tugas berdasarkan ID
        $pengumpulan = PengumpulanTugas::findOrFail($id);
    
        return view('murid.edit-tugas', compact('pengumpulan'));
    }

    public function update(Request $request, $id)
    {
        $pengumpulanTugas = PengumpulanTugas::findOrFail($id);
        $pengumpulanTugas->update([
            'deskripsi' => $request->deskripsi,
            'file' => $request->file('file')->store('pengumpulan_tugas'),
            // Update status jika perlu
        ]);
    
        return redirect()->route('murid.detail-tugas', $pengumpulanTugas->tugas_id)
                         ->with('success', 'Tugas berhasil diperbarui!');
    }

        public function updateTugas(Request $request, $id)
    {
        $request->validate([
            'file' => 'nullable|file|max:2048', // Aturan validasi file
            'catatan' => 'nullable|string|max:255', // Aturan validasi catatan
        ]);

        $pengumpulan = PengumpulanTugas::findOrFail($id);

        // Update catatan jika ada
        if ($request->has('catatan')) {
            $pengumpulan->catatan = $request->catatan;
        }

        // Cek apakah ada file yang diupload
        if ($request->file) {
            // Hapus file yang lama jika ada
            if ($pengumpulan->file) {
                Storage::delete($pengumpulan->file);
            }
            // Simpan file baru
            $pengumpulan->file = $request->file('file')->store('tugas');
        }

        $pengumpulan->save();

        return redirect()->route('murid.lihat-tugas', $pengumpulan->tugas_id)->with('success', 'Tugas berhasil diperbarui.');
    }

}
