@extends('layouts.header.admin')

@section('title', 'Tambah Murid')

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
                            <i class="bi bi-person-plus-fill text-primary me-2"></i>Tambah Murid
                        </h2>
                    </div>

                    <form action="{{ route('murid.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           name="name" 
                                           id="name" 
                                           value="{{ old('name') }}" 
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
                                           value="{{ old('email') }}" 
                                           required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           name="password" 
                                           id="password" 
                                           required>
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
                                           id="password_confirmation" 
                                           required>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('murid.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i>Simpan
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