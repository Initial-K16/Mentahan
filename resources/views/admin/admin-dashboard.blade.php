@extends('layouts.header.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-2 d-none d-md-block">
            @include('layouts.sidebar.admin-sidebar')
        </div>
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard Admin</h2>
                    <div class="alert alert-info" role="alert">
                        <i class="bi bi-person-check-fill"></i> Selamat datang, <strong>{{ Auth::user()->name }}</strong>! Anda login sebagai Admin.
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4 mb-3">
                            <div class="card bg-primary text-white h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-person-video3"></i> Total Pengajar</h5>
                                    <p class="card-text display-4">{{ $totalPengajar }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card bg-success text-white h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-mortarboard-fill"></i> Total Siswa</h5>
                                    <p class="card-text display-4">{{ $totalSiswa }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card bg-danger text-white h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-book-fill"></i> Total Kelas</h5>
                                    <p class="card-text display-4">{{ $totalKelas }}</p>
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
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease-in-out;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .display-4 {
        font-size: 2.5rem;
        font-weight: bold;
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