<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\MuridProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\MuridDashboardController;
use App\Http\Controllers\PengajarProfileController;
use App\Http\Controllers\PengajarDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard routes for different roles
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.admin-dashboard'); // Pastikan path sesuai dengan file yang kamu buat
    })->name('admin.dashboard');
// Route untuk dashboard admin
Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.admin-dashboard');
// Route untuk pengajar
Route::resource('admin/pengajar', PengajarController::class);
 // Route untuk mata pelajaran
 Route::resource('admin/mapel', MapelController::class);
//  Route untuk murid
 Route::resource('admin/murid', MuridController::class);
//  Route untuk kelas
Route::resource('admin/kelas', KelasController::class);
// Route untuk profil admin
    Route::get('/admin/profile', [AdminProfileController::class, 'index'])->name('admin.profile.index');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/admin/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');
});



Route::middleware(['auth', 'role:pengajar'])->group(function () {
    Route::get('/dashboard/pengajar', function () {
        return view('pengajar.pengajar-dashboard');
    })->name('pengajar.dashboard');

    // Route untuk materi
    Route::resource('/pengajar/materi', MateriController::class);

    // Route untuk tugas
    Route::resource('/pengajar/tugas', TugasController::class);

    // Route untuk upload
    Route::get('/pengajar/upload', [UploadController::class, 'index'])->name('upload.index');
    Route::post('/pengajar/upload', [UploadController::class, 'upload'])->name('upload.store');
    Route::get('/pengajar/upload', [UploadController::class, 'index'])->name('upload.index');
    Route::get('/pengajar/upload/create', [UploadController::class, 'create'])->name('upload.create');
    Route::post('/pengajar/upload', [UploadController::class, 'upload'])->name('upload.store');

    // Route untuk dashboard
    Route::get('/dashboard/pengajar', [PengajarDashboardController::class, 'index'])->name('pengajar.pengajar-dashboard');

    // Route untuk profile pengajar
    Route::get('/pengajar/profile', [PengajarProfileController::class, 'index'])->name('pengajar.profile.index');
    Route::get('/pengajar/profile/edit', [PengajarProfileController::class, 'edit'])->name('pengajar.profile.edit');
    Route::put('/pengajar/profile', [PengajarProfileController::class, 'update'])->name('pengajar.profile.update');
    
    // Route untuk menyimpan pengumpulan tugas
    Route::get('/pengajar/pengumpulan-tugas', [PengajarDashboardController::class, 'showPengumpulanTugas'])->name('pengajar.tugas.tugas-murid');

    // Route untuk konfirmasi tugas
    Route::post('/tugas/konfirmasi/{id}', [PengajarDashboardController::class, 'confirmTugas'])->name('tugas.konfirmasi');

});




Route::middleware(['auth', 'role:murid'])->group(function () {
    Route::get('/murid/dashboard', function () {
        return view('murid.murid-dashboard');
    })->name('murid.dashboard');

    // Rute dashboard
    Route::get('/murid/dashboard', [MuridDashboardController::class, 'index'])->name('murid.murid-dashboard');

    // Rute lihat materi
    Route::get('/murid/materi/{id}', [MuridDashboardController::class, 'lihatMateri'])->name('murid.lihat-materi');

    // Rute lihat materi
    Route::get('/murid/tugas/{id}', [MuridDashboardController::class, 'lihatTugas'])->name('murid.lihat-tugas');

    // Rute kirim tugas
    Route::get('/murid/tugas/{id}/kirim', [TugasController::class, 'showKirimTugasForm'])->name('murid.kirim-tugas');
    Route::post('/murid/tugas/{id}/kirim', [TugasController::class, 'kirimTugas'])->name('murid.kirim.tugas');
    
    //  Rute untuk edit tugas
    Route::get('/murid/edit-tugas/{id}', [MuridDashboardController::class, 'editTugas'])->name('murid.edit-tugas');

    //Rute utk update tgs
    Route::put('/murid/update-tugas/{id}', [MuridDashboardController::class, 'updateTugas'])->name('murid.update-tugas');

    // Route untuk Profil murid
    Route::get('murid/profile', [MuridProfileController::class, 'index'])->name('murid.profile.index');
    Route::get('murid/profile/edit', [MuridProfileController::class, 'edit'])->name('murid.profile.edit');
    Route::put('murid/profile/update', [MuridProfileController::class, 'update'])->name('murid.profile.update');

});



Route::middleware(['auth', 'cekKelas'])->group(function () {
    Route::get('/murid/dashboard', [MuridDashboardController::class, 'index'])->name('murid.murid-dashboard');
});
Route::middleware('auth')->group(function () {
    Route::get('/murid/pilih-kelas', [KelasController::class, 'pilihKelas'])->name('murid.pilih-kelas');
    Route::post('/murid/simpan-kelas', [KelasController::class, 'simpanKelas'])->name('kelas.simpan');
});
