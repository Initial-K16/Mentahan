@extends('layouts.header.pengajar')

@section('title', 'Dashboard Pengajar')

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <div class="d-flex align-items-center">
                    <i class="bi bi-speedometer2 text-primary me-2" style="font-size: 1.25rem;"></i>
                    <h5 class="mb-0 fw-semibold">Dashboard Pengajar</h5>
                </div>
            </div>
            <div class="card-body">
                <!-- Welcome Section -->
                <div class="welcome-section mb-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar-circle me-3">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo) }}" alt="Profile Photo" class="img-profile rounded-circle">
                            @else
                                <i class="bi bi-person-circle text-white"></i>
                            @endif
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Selamat datang, {{ Auth::user()->name }}!</h5>
                            <p class="text-muted small mb-0">
                                <i class="bi bi-check2-circle me-1"></i>
                                Anda login sebagai Pengajar
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Statistics Section -->
                <div class="statistics-section">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-graph-up text-primary me-2"></i>
                        Statistik Overview
                    </h6>
                    <div class="row g-3">
                        <!-- Materi Card -->
                        <div class="col-md-4">
                            <div class="card h-100 stat-card border-0">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-primary fw-semibold mb-1">Total Materi</p>
                                            <h3 class="fw-bold mb-0">{{ $materiCount }}</h3>
                                        </div>
                                        <div class="icon-circle bg-primary bg-opacity-10">
                                            <i class="bi bi-journal-richtext text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tugas Card -->
                        <div class="col-md-4">
                            <div class="card h-100 stat-card border-0">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-success fw-semibold mb-1">Total Tugas</p>
                                            <h3 class="fw-bold mb-0">{{ $tugasCount }}</h3>
                                        </div>
                                        <div class="icon-circle bg-success bg-opacity-10">
                                            <i class="bi bi-clipboard-check text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Uploads Card -->
                        <div class="col-md-4">
                            <div class="card h-100 stat-card border-0">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-warning fw-semibold mb-1">Total Upload</p>
                                            <h3 class="fw-bold mb-0">{{ $uploadsCount }}</h3>
                                        </div>
                                        <div class="icon-circle bg-warning bg-opacity-10">
                                            <i class="bi bi-cloud-upload text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-circle {
    width: 45px;
    height: 45px;
    background-color: #0d6efd;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden; /* Penting untuk memastikan gambar tidak keluar dari lingkaran */
}

.img-profile {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Memastikan gambar mengisi sempurna dan tetap proporsional */
}

.welcome-section {
    background-color: #f8f9fa;
    padding: 1.25rem;
    border-radius: 0.5rem;
}

.icon-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon-circle i {
    font-size: 1.25rem;
}

.stat-card {
    transition: all 0.3s ease;
    box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
}

.card-body {
    padding: 1.25rem;
}

@media (max-width: 768px) {
    .welcome-section {
        padding: 1rem;
    }
    
    h5.fw-bold {
        font-size: 1rem;
    }
    
    .statistics-section h3 {
        font-size: 1.25rem;
    }
    
    .icon-circle {
        width: 35px;
        height: 35px;
    }
    
    .icon-circle i {
        font-size: 1rem;
    }
}
</style>
@endsection