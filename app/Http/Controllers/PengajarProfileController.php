<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mapel;
use App\Models\Tugas;
use App\Models\Materi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajarProfileController extends Controller
{
    public function index()
    {
        // Ambil jumlah materi, tugas, dan upload yang telah dibuat pengajar
        $materiCount = Materi::where('pengajar_id', Auth::id())->count();
        $tugasCount = Tugas::where('pengajar_id', Auth::id())->count();
        $uploadsCount = $materiCount + $tugasCount;

        // Ambil data user yang sedang login
        $pengajar = Auth::user();

        // Ambil mata pelajaran pertama yang diajarkan oleh pengajar
        $mapel = $pengajar->mapels->first();

        return view('pengajar.profile.index', compact('pengajar', 'materiCount', 'tugasCount', 'uploadsCount', 'mapel'));
    }

    public function edit()
    {
        // Tampilkan form edit profile
        $pengajar = Auth::user();
        return view('pengajar.profile.edit', compact('pengajar'));
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

        $pengajar = Auth::user();
        $pengajar->name = $request->input('name');
        $pengajar->email = $request->input('email');

        // Proses update password jika ada input
        if ($request->filled('password')) {
            $pengajar->password = bcrypt($request->input('password'));
        }

        // Proses upload foto profil jika ada
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($pengajar->profile_photo) {
                Storage::delete('public/' . $pengajar->profile_photo);
            }

                  // Simpan foto profil baru
                  $file = $request->file('profile_photo');
                  $filename = time() . '_' . $file->getClientOriginalName(); // Buat nama file yang unik
                  $file->storeAs('public/profile_photos', $filename); // Simpan di storage/public/profile_photos
                  $pengajar->profile_photo = $filename; // Simpan hanya nama file di database
              }

        // Simpan perubahan data
        $pengajar->save();

        return redirect()->route('pengajar.profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
