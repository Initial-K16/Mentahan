@extends('layouts.header.pengajar')

@section('title', 'Detail Tugas')

@section('content')
<div class="row">
    <div class="col-md-2">
        @include('layouts.sidebar.pengajar-sidebar') <!-- Menyertakan sidebar -->
    </div>
    <div class="col-md-10">
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-info-circle me-2"></i>Detail Tugas
                </h5>
            </div>
            <div class="card-body">
                <h6 class="font-weight-bold">Informasi Pengajar dan Mata Pelajaran:</h6>
                <div class="mb-3 p-3 bg-light rounded d-flex align-items-center">
                    <div class="profile-photo me-3">
                        <img src="{{ $tugas->pengajar->profile_photo ? asset('storage/profile_photos/' . $tugas->pengajar->profile_photo) : asset('default_profile.png') }}" alt="Profile Photo" class="rounded-circle" width="100">
                    </div>
                    <div>
                        <p class="mb-1">
                            <span class="font-weight-bold">Nama Pengajar: </span>
                            {{ $tugas->pengajar->name }}
                        </p>
                        <p class="mb-0">
                            <span class="font-weight-bold">Mata Pelajaran: </span>
                            {{ $mapel->nama }}
                        </p>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="font-weight-bold">Judul:</h6>
                    <p class="lead">{{ $tugas->judul }}</p>
                </div>

                <hr>

                <div class="mb-4">
                    <h6 class="font-weight-bold">Deskripsi:</h6>
                    <p>{!! $tugas->deskripsi !!}</p>
                </div>

                <hr>

                <div class="mb-4">
                    <h6 class="font-weight-bold">Batas Waktu:</h6>
                    <p>{{ $tugas->batas_waktu }}</p>
                </div>

                <hr>

                <div class="mb-4">
                    <h6 class="font-weight-bold">File Tugas:</h6>
                    <p>
                        @if ($tugas->file)
                            <a href="{{ asset('storage/' . $tugas->file) }}" class="btn btn-link" target="_blank">
                                <i class="bi bi-file-earmark-text me-1"></i>{{ basename($tugas->file) }}
                            </a>
                        @else
                            <span class="text-muted">Tidak ada file yang tersedia.</span>
                        @endif
                    </p>
                </div>

                <hr>

                <div class="text-right mt-4">
                    <a href="{{ route('tugas.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .profile-photo img {
        border: 2px solid #007bff; /* Border untuk foto profil */
    }
    .card-header {
        border-bottom: 2px solid #0056b3; /* Garis bawah pada header */
    }
    .lead {
        font-size: 1.25rem; /* Ukuran font untuk judul */
    }
    .btn-link {
        color: #007bff; /* Warna link */
        text-decoration: none; /* Menghilangkan garis bawah */
    }
    .btn-link:hover {
        text-decoration: underline; /* Garis bawah saat hover */
    }
</style>
@endpush

@endsection