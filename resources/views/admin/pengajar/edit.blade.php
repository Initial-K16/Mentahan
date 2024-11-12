@extends('layouts.header.admin')

@section('title', 'Edit Pengajar')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title mb-4"><i class="bi bi-person-gear me-2"></i>Edit Pengajar</h2>
                    <form method="POST" action="{{ route('pengajar.update', $pengajar->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label"><i class="bi bi-person me-2"></i>Nama</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $pengajar->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label"><i class="bi bi-envelope me-2"></i>Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', $pengajar->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="mapel" class="form-label"><i class="bi bi-book me-2"></i>Mata Pelajaran</label>
                            <select name="mapel[]" class="form-select @error('mapel') is-invalid @enderror" id="mapel">
                                <option value="">-- Pilih Mapel --</option>
                                @foreach ($mapels as $mapel)
                                    <option value="{{ $mapel->id }}" 
                                        {{ $pengajar->mapels->contains($mapel->id) ? 'selected' : '' }}>
                                        {{ $mapel->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mapel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label"><i class="bi bi-lock me-2"></i>Password Baru</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                                <small class="form-text text-muted"><i class="bi bi-info-circle me-1"></i>Biarkan kosong jika tidak ingin mengubah password</small>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label"><i class="bi bi-lock-fill me-2"></i>Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('pengajar.index') }}" class="btn btn-secondary">
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
    .form-control, .form-select {
        border-radius: 8px;
        padding: 0.75rem 1rem;
    }
    .form-select {
        cursor: pointer;
    }
    .btn {
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
    }
    .card-title {
        color: #333;
        font-weight: 600;
    }
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
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