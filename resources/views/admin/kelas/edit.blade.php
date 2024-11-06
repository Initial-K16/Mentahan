@extends('layouts.header.admin')

@section('title', 'Edit Kelas')

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
                            <i class="bi bi-pencil-square text-primary me-2"></i>Edit Kelas
                        </h2>
                    </div>

                    <form action="{{ route('kelas.update', $kela->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_kelas" class="form-label">Kelas</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-mortarboard"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control @error('nama_kelas') is-invalid @enderror" 
                                           name="nama_kelas" 
                                           id="nama_kelas" 
                                           value="{{ old('nama_kelas', $kela->nama_kelas) }}" 
                                           required>
                                </div>
                                @error('nama_kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="jurusan" class="form-label">Jurusan</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-diagram-2"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control @error('jurusan') is-invalid @enderror" 
                                           name="jurusan" 
                                           id="jurusan" 
                                           value="{{ old('jurusan', $kela->jurusan) }}" 
                                           required>
                                </div>
                                @error('jurusan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('kelas.index') }}" class="btn btn-secondary">
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