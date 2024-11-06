<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Hitung total pengajar (role = 'pengajar')
        $totalPengajar = User::where('role', 'pengajar')->count();

        // Hitung total siswa (role = 'murid')
        $totalSiswa = User::where('role', 'murid')->count();

        // Hitung total kelas
        $totalKelas = Kelas::count();

        return view('admin.admin-dashboard', compact('totalPengajar', 'totalSiswa', 'totalKelas'));
    }
}