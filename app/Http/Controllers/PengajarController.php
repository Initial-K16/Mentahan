<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PengajarController extends Controller
{
    public function index()
    {
        // Mengambil pengajar dengan eager loading untuk mapels
        $pengajars = User::with('mapels')->where('role', 'pengajar')->get();
        return view('admin.pengajar.index', compact('pengajars'));
    }

    public function create()
    {
        $mapels = Mapel::all(); // Ambil semua mata pelajara
        return view('admin.pengajar.create', compact('mapels'));
    }

        public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'mapel' => 'required|array', // Validasi mapel harus berupa array
        ]);

        $pengajar = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pengajar', // Mengatur role sebagai pengajar
        ]);

        // Mengaitkan pengajar dengan mata pelajaran yang dipilih
        $pengajar->mapels()->attach($request->mapel);

        return redirect()->route('pengajar.index')->with('success', 'Pengajar berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengajar = User::with('mapels')->findOrFail($id); // Mengambil pengajar beserta mapels
        $mapels = Mapel::all(); // Mengambil semua mata pelajaran untuk ditampilkan di form
        return view('admin.pengajar.edit', compact('pengajar', 'mapels'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'mapel' => 'required|array', // Validasi mapel harus berupa array
        ]);
    
        $pengajar = User::findOrFail($id);
        $pengajar->name = $request->name;
        $pengajar->email = $request->email;
    
        if ($request->password) {
            $pengajar->password = Hash::make($request->password);
        }
    
        $pengajar->save();
    
        // Mengaitkan pengajar dengan mata pelajaran yang dipilih
        $pengajar->mapels()->sync($request->mapel);
    
        return redirect()->route('pengajar.index')->with('success', 'Pengajar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengajar = User::findOrFail($id);
        $pengajar->delete();

        return redirect()->route('pengajar.index')->with('success', 'Pengajar berhasil dihapus.');
    }
}
