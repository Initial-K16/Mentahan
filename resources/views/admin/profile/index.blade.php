@extends('layouts.header.admin')

@section('title', 'Profil Admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card profile-card">
                <div class="card-body p-4">
                    <!-- Header Profile -->
                    <div class="text-center mb-4">
                        <div class="profile-image mb-3">
                            <img src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo) }}" 
                                 alt="Profile Photo" class="rounded-circle">
                        </div>
                        <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                        <p class="text-muted">{{ Auth::user()->role }}</p>
                    </div>

                    <hr>

                    <!-- Informasi Profil -->
                    <div class="profile-info">
                        <div class="info-item">
                            <span class="info-label">
                                <i class="bi bi-envelope"></i> Email
                            </span>
                            <span class="info-value">{{ Auth::user()->email }}</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">
                                <i class="bi bi-telephone"></i> Nomor Telepon
                            </span>
                            <span class="info-value">{{ Auth::user()->phone ?? 'Tidak Ada' }}</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">
                                <i class="bi bi-person-badge"></i> Status
                            </span>
                            <span class="info-value">{{ Auth::user()->status ?? 'Aktif' }}</span>
                        </div>
                    </div>

                    <div class="profile-actions mt-4">
                        <a href="{{ route('admin.profile.edit', Auth::user()->id) }}" class="btn btn-primary btn-block">
                            <i class="bi bi-pencil-square"></i> Edit Profil
                        </a>
                        <a href="{{ route('admin.admin-dashboard') }}" class="btn btn-outline-secondary btn-block mt-2">
                            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan SweetAlert2 CSS dan JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let successMessage = "{{ session('success') }}";
        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: successMessage,
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = new URL(window.location.href);
                    url.searchParams.delete('success');
                    history.replaceState(null, '', url);
                }
            });
        }
    });
</script>

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

    .animated {
        animation-duration: 0.3s;
        animation-fill-mode: both;
    }

    .zoomIn {
        animation-name: zoomIn;
    }

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale3d(0.3, 0.3, 0.3);
        }
        50% {
            opacity: 1;
        }
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

    @media (max-width: 500px) {
        .swal2-popup {
            width: 90% !important;
        }
    }
</style>
@endsection