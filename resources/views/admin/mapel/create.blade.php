@extends('layouts.header.admin')

@section('title', 'Tambah Mata Pelajaran')

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
                            <i class="bi bi-plus-circle-fill text-primary me-2"></i>Tambah Mata Pelajaran
                        </h2>
                    </div>

                    <form action="{{ route('mapel.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nama" class="form-label">Nama Mata Pelajaran</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-book"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control @error('nama') is-invalid @enderror" 
                                           name="nama" 
                                           id="nama" 
                                           value="{{ old('nama') }}" 
                                           placeholder="Masukkan nama mata pelajaran"
                                           required>
                                </div>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('mapel.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left me-1"></i>Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i>Simpan
                                    </button>
                                </div>
                            </div>
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

    .input-group:focus-within .input-group-text {
        border-color: #86b7fe;
    }

    .input-group:focus-within .form-control {
        border-color: #86b7fe;
    }
</style>

@endsection