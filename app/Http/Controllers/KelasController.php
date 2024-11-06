<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User; // Pastikan Anda mengimpor model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    public function index()
    {
        // Ambil data kelas dengan pagination, batasi 5 data per halaman
        $kelases = Kelas::paginate(5);

        return view('admin.kelas.index', compact('kelases'));
    }
    public function create()
    {
        return view('admin.kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);

        Kelas::create($request->all());

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function edit(Kelas $kela)
    {
        return view('admin.kelas.edit', compact('kela'));
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);

        $kela->update($request->all());

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui');
    }

    public function destroy(Kelas $kela)
    {
        $kela->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus');
    }

    public function pilihKelas()
    {
        // Ambil semua data kelas
        $kelas = Kelas::all();
    
        return view('murid.pilih-kelas', compact('kelas'));
    }

        public function simpanKelas(Request $request)
    {
        // Validasi input
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $user = Auth::user();

        // Ambil jurusan berdasarkan kelas yang dipilih
        $kelas = Kelas::find($request->kelas_id);
        if (!$kelas) {
            return redirect()->back()->withErrors(['kelas_id' => 'Kelas tidak ditemukan.']);
        }

        // Simpan ke tabel kelas_user
        $user->kelas()->attach($request->kelas_id, ['jurusan' => $kelas->jurusan]);

        return redirect()->route('murid.murid-dashboard')->with('message', 'Kelas dan jurusan berhasil dipilih.');
    }

}