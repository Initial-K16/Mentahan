@extends('layouts.header.murid')

@section('title', 'Profil Murid')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h2 class="font-weight-bold mb-3">
                            <i class="bi bi-person-circle me-2"></i>Profil Murid
                        </h2>
                        <div class="profile-photo-container mb-4">
                            @if($murid->profile_photo)
                                <img src="{{ asset('storage/profile_photos/' . $murid->profile_photo) }}" alt="Profile Photo" class="img-fluid rounded-circle">
                            @else
                                <img src="{{ asset('default_profile.png') }}" alt="Default Profile" class="img-fluid rounded-circle">
                            @endif
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="info-group">
                                <h5 class="text-muted"><i class="bi bi-person-fill me-2"></i>Nama</h5>
                                <p class="lead">{{ $murid->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-group">
                                <h5 class="text-muted"><i class="bi bi-envelope-fill me-2"></i>Email</h5>
                                <p class="lead">{{ $murid->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6 mb-3">
                            <div class="info-group">
                                <h5 class="text-muted"><i class="bi bi-book-fill me-2"></i>Kelas</h5>
                                <p class="lead">{{ $namaKelas }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-group">
                                <h5 class="text-muted"><i class="bi bi-bookmark-fill me-2"></i>Jurusan</h5>
                                <p class="lead">{{ $jurusanKelas }}</p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('murid.profile.edit') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-pencil-square me-2"></i> Edit Profil
                        </a>
                        <a href="{{ route('murid.murid-dashboard') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="bi bi-arrow-left me-2"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    body {
        background-color: #f8f9fa;
    }
    .card {
        border: none;
        border-radius: 15px;
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
    }
    .profile-photo-container {
        width: 150px;
        height: 150px;
        margin: 0 auto;
        overflow: hidden;
        border-radius: 50%;
        border: 5px solid #fff;
        box-shadow: 0 0 20px rgba(0,0,0,.1);
    }
    .profile-photo-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .text-muted {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 0.3rem;
    }
    .lead {
        font-size: 1.1rem;
        font-weight: 500;
        color: #2c3e50;
    }
    .btn-primary, .btn-outline-secondary {
        transition: all 0.3s ease;
        padding: 10px 20px;
    }
    .btn-primary:hover, .btn-outline-secondary:hover {
        transform: translateY(-2px);
    }
    .info-group {
        background-color: #ffffff;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,.04);
        height: 100%;
    }
    .info-group .text-muted {
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.8rem;
    }
    .info-group .lead {
        margin-bottom: 0;
    }
    hr {
        border-top: 2px solid rgba(0,0,0,.1);
    }
    @media (max-width: 768px) {
        .profile-photo-container {
            width: 120px;
            height: 120px;
        }
        .lead {
            font-size: 1rem;
        }
        .btn-lg {
            padding: 8px 16px;
            font-size: 0.9rem;
        }
    }
</style>