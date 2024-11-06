@extends('layouts.header.admin')

@section('title', 'Data Pengajar')

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
                        <h2 class="card-title">
                            <i class="bi bi-person-video3 text-primary me-2"></i>Data Pengajar
                        </h2>
                        <a href="{{ route('pengajar.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Pengajar
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">Foto</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Mata Pelajaran</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajars as $pengajar)
                                    <tr class="align-middle">
                                        <td class="text-center">
                                            <div class="avatar-wrapper">
                                                @if ($pengajar->profile_photo)
                                                    <img src="{{ asset('storage/profile_photos/' . $pengajar->profile_photo) }}" 
                                                         alt="Profile Photo" 
                                                         class="profile-photo">
                                                @else
                                                    <img src="{{ asset('storage/profile_photos/default_profile.png') }}" 
                                                         alt="Default Profile Photo" 
                                                         class="profile-photo">
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $pengajar->name }}</div>
                                        </td>
                                        <td>
                                            <div class="text-muted">
                                                <i class="bi bi-envelope"></i> {{ $pengajar->email }}
                                            </div>
                                        </td>
                                        <td>
                                            @foreach ($pengajar->mapels as $mapel)
                                                <span class="badge bg-primary rounded-pill">{{ $mapel->nama }}</span>
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('pengajar.edit', $pengajar->id) }}" 
                                                   class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                    <form action="{{ route('pengajar.destroy', $pengajar->id) }}" method="POST" onsubmit="confirmDelete(event, this)" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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

    .profile-photo {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .profile-photo:hover {
        transform: scale(1.1);
    }

    .btn {
        border-radius: 8px;
        padding: 0.5rem 1rem;
        transition: all 0.2s;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .badge {
        font-weight: 500;
        padding: 0.5em 1em;
        margin: 0.2em;
    }

    .table > :not(caption) > * > * {
        padding: 1rem 0.75rem;
    }

    .alert {
        border-radius: 10px;
    }

    .btn-group {
        gap: 0.5rem;
    }

    @media (max-width: 768px) {
        .d-none {
            display: none;
        }
        
        .col-md-10 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>
@endsection