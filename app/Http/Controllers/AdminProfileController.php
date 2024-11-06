<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kelas;

class AdminProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::user();

        // Hitung total pengajar (role = 'pengajar')
        $totalPengajar = User::where('role', 'pengajar')->count();

        // Hitung total siswa (role = 'murid')
        $totalSiswa = User::where('role', 'murid')->count();

        // Hitung total kelas
        $totalKelas = Kelas::count();

        return view('admin.profile.index', compact('admin', 'totalPengajar', 'totalSiswa', 'totalKelas'));

    }

    public function edit()
    {
        $admin = Auth::user();
        return view('admin.profile.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk foto profil
        ]);

        $admin = Auth::user();
        $admin->name = $request->name;
        $admin->email = $request->email;

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        // Jika ada foto profil yang diupload
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($admin->profile_photo) {
                \Storage::delete('public/profile_photos/' . $admin->profile_photo);
            }
        
            // Simpan foto profil baru
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName(); // Buat nama file yang unik
            $file->storeAs('public/profile_photos', $filename); // Simpan di storage/public/profile_photos
            $admin->profile_photo = $filename; // Simpan hanya nama file di database
        }
        

        $admin->save();

        return redirect()->route('admin.profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}