@extends('layouts.header.pengajar')

@section('title', 'Edit Profil Pengajar')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h3 class="mb-4 text-center"><i class="bi bi-person-gear"></i> Edit Profil</h3>
                    <form action="{{ route('pengajar.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="d-flex align-items-center mb-4">
                            <img id="profile-photo-preview" src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo) }}" alt="Profile Photo" class="rounded-circle me-3" width="100" height="100">
                            <div>
                                <h5 class="mb-1">Foto Profil Saat Ini</h5>
                                <p class="text-muted mb-0">Pratinjau foto profil baru akan muncul di sini</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label"><i class="bi bi-person-fill"></i> Nama</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $pengajar->name) }}" required placeholder="Nama Lengkap">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i> Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $pengajar->email) }}" required placeholder="Email Aktif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label"><i class="bi bi-lock-fill"></i> Password Baru <small>(Opsional)</small></label>
                                <input type="password" class="form-control" name="password" placeholder="Biarkan kosong jika tidak ingin mengubah">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label"><i class="bi bi-lock-fill"></i> Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Masukkan ulang password baru">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="profile_photo" class="form-label"><i class="bi bi-image-fill"></i> Foto Profil</label>
                            <input type="file" class="form-control" name="profile_photo" onchange="previewProfilePhoto(event)">
                            <small class="form-text text-muted">Unggah foto profil dengan format JPEG, PNG, atau JPG maksimal 2MB.</small>
                        </div>



                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('pengajar.profile.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewProfilePhoto(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('profile-photo-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<style>
    .card {
        border-radius: 15px;
    }
    .form-label {
        font-weight: 600;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
    }
    .btn-outline-secondary:hover {
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
    }
    @media (max-width: 768px) {
        .col-md-8 {
            padding: 0 15px;
        }
    }
</style>
@endsection