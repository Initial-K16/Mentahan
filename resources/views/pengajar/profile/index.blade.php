@extends('layouts.header.pengajar')

@section('title', 'Profil Pengajar')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card profile-card">
                <div class="card-body p-4">
                    <!-- Header Profile -->
                    <div class="text-center mb-4">
                        <div class="profile-image mb-3">
                            @if($pengajar->profile_photo)
                                <img src="{{ asset('storage/profile_photos/' . $pengajar->profile_photo) }}" 
                                     alt="Profile Photo" class="rounded-circle">
                            @else
                                <img src="{{ asset('default_profile.png') }}" 
                                     alt="Default Profile" class="rounded-circle">
                            @endif
                        </div>
                        <h4 class="mb-1">{{ $pengajar->name }}</h4>
                        <p class="text-muted">Pengajar</p>
                    </div>

                    <hr>

                    <!-- Informasi Profil -->
                    <div class="profile-info">
                        <div class="info-item">
                            <span class="info-label">
                                <i class="bi bi-envelope"></i> Email
                            </span>
                            <span class="info-value">{{ $pengajar->email }}</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">
                                <i class="bi bi-book"></i> Mata Pelajaran
                            </span>
                            <span class="info-value">{{ $mapel ? $mapel->nama : 'Belum ditentukan' }}</span>
                        </div>
                    </div>

                    <div class="profile-actions mt-4">
                        <a href="{{ route('pengajar.profile.edit') }}" class="btn btn-primary btn-block">
                            <i class="bi bi-pencil-square"></i> Edit Profil
                        </a>
                        <a href="{{ route('pengajar.pengajar-dashboard') }}" class="btn btn-outline-secondary btn-block mt-2">
                            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }

    .profile-image {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto;
    }

    .profile-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .profile-info {
        margin-top: 1.5rem;
    }

    .info-item {
        padding: 1rem;
        margin-bottom: 0.5rem;
        background-color: #f8f9fa;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .info-label {
        color: #6c757d;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-value {
        font-weight: 500;
        color: #2c3e50;
    }

    hr {
        margin: 1.5rem 0;
        opacity: 0.1;
    }

    .btn-block {
        display: block;
        width: 100%;
    }

    @media (max-width: 768px) {
        .profile-image {
            width: 100px;
            height: 100px;
        }

        .info-item {
            flex-direction: column;
            text-align: center;
            gap: 8px;
        }
    }
</style>
@endsection