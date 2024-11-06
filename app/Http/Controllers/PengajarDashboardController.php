<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Materi;
use App\Models\PengumpulanTugas;
use Illuminate\Support\Facades\Auth;

class PengajarDashboardController extends Controller
{
    public function index()
    {
        // Ambil jumlah materi, tugas, dan uploads oleh pengajar yang sedang login
        $materiCount = Materi::where('pengajar_id', Auth::id())->count();
        $tugasCount = Tugas::where('pengajar_id', Auth::id())->count();
        
        // Ambil jumlah materi dan tugas yang diupload
        $uploadsCount = $materiCount + $tugasCount;

        return view('pengajar.pengajar-dashboard', compact('materiCount', 'tugasCount', 'uploadsCount'));
    }

    public function showPengumpulanTugas()
    {
         // Ambil semua tugas yang diajarkan oleh pengajar
         $tugas = Tugas::with('pengumpulanTugas.user')->where('pengajar_id', auth()->id())->get();

         // Group data by kelas
        $groupedTugas = $tugas->groupBy(function ($item) {
            return optional($item->pengumpulanTugas->first()->user->kelas->first())->nama_kelas;
        });

        return view('pengajar.tugas.tugas-murid', compact('tugas', 'groupedTugas'));
    }

    public function confirmTugas($id)
    {
        // Temukan data pengumpulan tugas berdasarkan ID
        $pengumpulanTugas = PengumpulanTugas::findOrFail($id);

        // Update kolom tugas_dikonfirmasi menjadi true
        $pengumpulanTugas->tugas_dikonfirmasi = true;
        $pengumpulanTugas->save();

        return redirect()->back()->with('success', 'Tugas berhasil dikonfirmasi!');
    }
    
}