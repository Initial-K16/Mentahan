@extends('layouts.header.admin')

@section('title', 'Edit Murid')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-2 d-none d-md-block">
            @include('layouts.sidebar.admin-sidebar')
        </div>
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="card-title mb-0">
                            <i class="bi bi-person-gear text-primary me-2"></i>Edit Murid
                        </h2>
                    </div>

                    <form action="{{ route('murid.update', $murid->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           name="name" 
                                           id="name" 
                                           value="{{ old('name', $murid->name) }}" 
                                           required>
                                </div>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           name="email" 
                                           id="email" 
                                           value="{{ old('email', $murid->email) }}" 
                                           required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           name="password" 
                                           id="password">
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" 
                                           class="form-control" 
                                           name="password_confirmation" 
                                           id="password_confirmation">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="profile_photo" class="form-label">Foto Profil</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-image"></i></span>
                                    <input type="file" 
                                           class="form-control @error('profile_photo') is-invalid @enderror" 
                                           name="profile_photo" 
                                           id="profile_photo" 
                                           accept="image/*">
                                </div>
                                @error('profile_photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            @if($murid->profile_photo)
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Foto Profil Saat Ini</label>
                                <div class="current-photo">
                                    <img src="{{ asset('storage/profile_photos/' . $murid->profile_photo) }}" 
                                         alt="Current Profile Photo" 
                                         class="img-thumbnail" 
                                         style="max-width: 150px;">
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('murid.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i>Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .form-label {
        font-weight: 500;
        color: #444;
    }

    .input-group-text {
        background-color: #f8f9fa;
        border-right: none;
    }

    .form-control {
        border-left: none;
    }

    .input-group-text,
    .form-control {
        border-color: #dee2e6;
    }

    .form-control:focus {
        border-color: #dee2e6;
        box-shadow: none;
    }

    .btn {
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
    }

    .card-title {
        color: #333;
        font-weight: 600;
    }

    .current-photo {
        padding: 1rem;
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    .img-thumbnail {
        border: 2px solid #dee2e6;
    }

    @media (max-width: 768px) {
        .col-md-2 {
            display: none;
        }
        .col-md-10 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>

@endsection