<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MuridProfileController extends Controller
{
    public function edit()
    {
        // Tampilkan form edit profile untuk murid
        $murid = Auth::user();
        return view('murid.profile.edit', compact('murid'));
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $murid = Auth::user();
        $murid->name = $request->input('name');
        $murid->email = $request->input('email');

        // Proses update password jika ada input
        if ($request->filled('password')) {
            $murid->password = bcrypt($request->input('password'));
        }

        // Proses upload foto profil jika ada
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($murid->profile_photo) {
                Storage::delete('public/' . $murid->profile_photo);
            }

            // Simpan foto profil baru
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName(); // Buat nama file yang unik
            $file->storeAs('public/profile_photos', $filename); // Simpan di storage/public/profile_photos
            $murid->profile_photo = $filename; // Simpan hanya nama file di database
        }

        // Simpan perubahan data
        $murid->save();

        return redirect()->route('murid.profile.index')->with('success', 'Profil berhasil diperbarui.');
    }

    public function index()
    {
        // Tampilkan halaman index profil murid
        $murid = Auth::user();
        $user = Auth::user();

        // Ambil kelas yang dipilih oleh murid
        $kelasUser = $user->kelas()->first();

         // Ambil jurusan dan nama kelas
         $jurusanKelas = $kelasUser ? $kelasUser->jurusan : null;
         $namaKelas = $kelasUser ? $kelasUser->nama_kelas : null;
 
        
        return view('murid.profile.index', compact('murid', 'namaKelas', 'jurusanKelas'));
    }
}
