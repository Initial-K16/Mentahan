@extends('layouts.header.pengajar')

@section('title', 'Detail Materi')

@section('content')
<div class="row">
    <div class="col-md-2">
        @include('layouts.sidebar.pengajar-sidebar') <!-- Menyertakan sidebar -->
    </div>
    <div class="col-md-10">
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-info-circle me-2"></i>Detail Materi
                </h5>
            </div>
            <div class="card-body">
                <h6 class="font-weight-bold">Informasi Pengajar dan Mata Pelajaran:</h6>
                <div class="mb-3 p-3 bg-light rounded d-flex align-items-center">
                    <div class="profile-photo me-3">
                        <img src="{{ $materi->pengajar->profile_photo ? asset('storage/profile_photos/' . $materi->pengajar->profile_photo) : asset('default_profile.png') }}" alt="Profile Photo" class="rounded-circle" width="100">
                    </div>
                    <div>
                        <p class="mb-1">
                            <span class="font-weight-bold">Nama Pengajar: </span>
                            {{ $materi->pengajar->name }}
                        </p>
                        <p class="mb-0">
                            <span class="font-weight-bold">Mata Pelajaran: </span>
                            {{ $mapel->nama }}
                        </p>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="font-weight-bold">Judul:</h6>
                    <p class="lead">{{ $materi->judul }}</p>
                </div>

                <hr>

                <div class="mb-4">
                    <h6 class="font-weight-bold">Deskripsi:</h6>
                    <p>{!! ($materi->deskripsi) !!}</p>
                </div>

                <hr>

                <div class="mb-4">
                    <h6 class="font-weight-bold">File Materi:</h6>
                    <p>
                        @if ($materi->file)
                            <a href="{{ asset('storage/' . $materi->file) }}" class="btn btn-link" target="_blank">
                                <i class="bi bi-file-earmark-text me-1"></i>{{ basename($materi->file) }}
                            </a>
                        @else
                            <span class="text-muted">Tidak ada file yang tersedia.</span>
                        @endif
                    </p>
                </div>

                <hr>

                <div class="mb-4">
                    <h6 class="font-weight-bold">URL Materi:</h6>
                    <p>
                        @if ($materi->url)
                            @if (strpos($materi->url, 'youtube.com') !== false || strpos($materi->url, 'youtu.be') !== false)
                                @php
                                    // Mengambil VIDEO_ID dari URL YouTube
                                    if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e|u|embed|watch|(?:.+)?\?v=))|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $materi->url, $matches)) {
                                        $videoId = $matches[1];
                                        $embedUrl = "https://www.youtube.com/embed/{$videoId}";
                                    }
                                @endphp
                                <iframe width="100%" height="400" src="{{ $embedUrl ?? '' }}" frameborder="0" allowfullscreen></iframe>
                            @else
                                <a href="{{ $materi->url }}" class="btn btn-link" target="_blank">
                                    <i class="bi bi-link-45deg me-1"></i>{{ $materi->url }}
                                </a>
                            @endif
                        @else
                            <span class="text-muted">Tidak ada URL yang tersedia.</span>
                        @endif
                    </p>
                </div>

                <hr>

                <div class="text-right mt-4">
                    <a href="{{ route('materi.index') }}" class="btn btn-secondary">
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
        border: 2px solid #007bff; /* Border untuk foto profil border-radius: 50%;
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