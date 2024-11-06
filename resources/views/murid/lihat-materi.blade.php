@extends('layouts.header.murid')

@section('title', 'Detail Materi')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8 col-md-10 col-sm-12">
            <div class="card shadow-lg border-0 rounded-lg">
                <!-- Card Header dengan gradien biru -->
                <div class="card-header py-3" style="background: linear-gradient(45deg, #4e73df, #224abe);">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 font-weight-bold text-white">
                            <i class="fas fa-book mr-2"></i>Detail Materi
                        </h4>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Informasi Pengajar -->
                    <div class="bg-white rounded-lg p-4 mb-4 border border-primary shadow-sm">
                        <h5 class="font-weight-bold mb-3 text-primary">
                            <i class="fas fa-user-tie mr-2"></i>Informasi Pengajar
                        </h5>
                        <div class="row align-items-center">
                            <div class="col-auto pr-4">
                                <img src="{{ $materi->pengajar->profile_photo ? asset('storage/profile_photos/' . $materi->pengajar->profile_photo) : asset('default_profile.png') }}" 
                                    alt="Profile Photo" 
                                    class="rounded-circle"
                                    style="width: 70px; height: 70px; object-fit: cover; border: 3px solid #4e73df;">
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <span class="text-muted small d-block mb-1">Nama Pengajar:</span>
                                    <div class="h6 font-weight-bold mb-0">{{ $materi->pengajar->name }}</div>
                                </div>
                                <div>
                                    <span class="text-muted small d-block mb-1">Mata Pelajaran:</span>
                                    <div class="h6 mb-0">{{ $mapel->nama }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Materi -->
                    <div class="bg-white rounded-lg p-3 mb-3 border border-primary shadow-sm">
                        <h5 class="font-weight-bold mb-2 text-primary">
                            <i class="fas fa-info-circle mr-2"></i>Detail Materi
                        </h5>
                        
                        <div class="mb-3">
                            <label class="text-muted small">Judul Materi</label>
                            <div class="h6 mb-0">{{ $materi->judul }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted small">Deskripsi</label>
                            <div class="border rounded p-2 bg-light" style="max-height: 150px; overflow-y: auto;">
                                {!! ($materi->deskripsi) !!}
                            </div>
                        </div>

                        <!-- File Materi -->
                        @if ($materi->file)
                            <div class="mb-3">
                                <label class="text-muted small">File Materi</label>
                                <div class="d-flex align-items-center bg-light border rounded p-2">
                                    <i class="fas fa-file-alt text-primary mr-2"></i>
                                    <div class="flex-grow-1 text-truncate mr-2">
                                        <small>{{ basename($materi->file) }}</small>
                                    </div>
                                    <a href="{{ asset('storage/' . $materi->file) }}" 
                                       class="btn btn-primary btn-sm" 
                                       download>
                                        <i class="fas fa-download mr-1"></i>Unduh
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="mb-3">
                                <label class="text-muted small">File Materi</label>
                                <div class="text-muted small">
                                    <i class="fas fa-info-circle mr-2"></i>Tidak ada file yang dilampirkan
                                </div>
                            </div>
                        @endif

                      <!-- URL Materi -->
<div class="mb-3">
    <label class="text-muted small">URL Materi</label>
    @if ($materi->url)
        @if (strpos($materi->url, 'youtube.com') !== false || strpos($materi->url, 'youtu.be') !== false)
            @php
                if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e|u|embed|watch|(?:.+)?\?v=))|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $materi->url, $matches)) {
                    $videoId = $matches[1];
                    $embedUrl = "https://www.youtube.com/embed/{$videoId}";
                }
            @endphp
            <div class="ratio ratio-16x9">
                <iframe 
                    src="{{ $embedUrl ?? '' }}" 
                    title="YouTube video"
                    allowfullscreen
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
                </iframe>
            </div>
        @else
            <div class="bg-light border rounded p-2">
                <a href="{{ $materi->url }}" class="btn btn-primary btn-sm" target="_blank">
                    <i class="fas fa-external-link-alt me-1"></i>Buka URL Materi
                </a>
            </div>
        @endif
    @else
        <div class="text-muted small">
            <i class="fas fa-info-circle me-2"></i>Tidak ada URL yang tersedia
        </div>
    @endif
</div>

                    <!-- Tombol Navigasi -->
                    <div class="bg-white rounded-lg p-4 border border-primary shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('murid.murid-dashboard') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .position-relative {
        position: relative;
    }
    .position-absolute {
        position: absolute;
    }
    .top-0 {
        top: 0;
    }
    .left-0 {
        left: 0;
    }
    .w-100 {
        width: 100%;
    }
    .h-100 {
        height: 100%;
    }
</style>
@endsection