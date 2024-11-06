@extends('layouts.header.murid')

@section('title', 'Edit Profil Murid')

@section('content')
<div class="container py-3 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body p-3 p-md-5">
                    <h2 class="card-title text-center mb-4">Edit Profil Murid</h2>

                    <form action="{{ route('murid.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Current Profile Photo Preview -->
                        <div class="text-center mb-4">
                            <img src="{{ Auth::user()->profile_photo ? asset('storage/profile_photos/' . Auth::user()->profile_photo) : asset('default_profile.png') }}" 
                                 alt="Current Profile Photo" 
                                 class="rounded-circle img-thumbnail" 
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        </div>

                        <!-- Form Fields -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                <input type="text" 
                                       name="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name', $murid->name) }}" 
                                       required>
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                <input type="email" 
                                       name="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email', $murid->email) }}" 
                                       required>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" 
                                       name="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="Kosongkan jika tidak ingin mengganti password">
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="profile_photo" class="form-label">Foto Profil Baru</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-image-fill"></i></span>
                                <input type="file" 
                                       name="profile_photo" 
                                       class="form-control @error('profile_photo') is-invalid @enderror"
                                       accept="image/*">
                            </div>
                            <div class="form-text">Format yang diizinkan: JPG, PNG. Maksimal 2MB</div>
                            @error('profile_photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('murid.murid-dashboard') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa;
    }
    
    .card {
        border: none;
        border-radius: 15px;
    }
    
    .form-label {
        font-weight: 600;
    }
    
    .input-group-text {
        background-color: #f8f9fa;
    }
    
    .btn-primary {
        background-color: #0d6efd;
        border: none;
    }
    
    .btn-primary:hover {
        background-color: #0b5ed7;
    }
    
    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }
</style>
@endsection