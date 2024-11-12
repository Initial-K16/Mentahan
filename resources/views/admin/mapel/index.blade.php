@extends('layouts.header.admin')

@section('title', 'Data Mata Pelajaran')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="card-title mb-0">
                            <i class="bi bi-book-half text-primary me-2"></i>Data Mata Pelajaran
                        </h2>
                        <a href="{{ route('mapel.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Mapel
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Mata Pelajaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mapels as $mapel)
                                    <tr>
                                        <td>
                                            <i class="bi bi-journal-text text-muted me-2"></i>
                                            {{ $mapel->nama }}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('mapel.edit', $mapel->id) }}" 
                                                   class="btn btn-warning btn-sm me-2" 
                                                   title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                    <form action="{{ route('mapel.destroy', $mapel->id) }}" method="POST" onsubmit="confirmDelete(event, this)" style="display: inline;">
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
    
    .table {
        vertical-align: middle;
    }
    
    .table th {
        font-weight: 600;
        color: #444;
    }
    
    .btn {
        border-radius: 8px;
        padding: 0.5rem 1rem;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
    }
    
    .card-title {
        color: #333;
        font-weight: 600;
    }
    
    .alert {
        border-radius: 10px;
    }
    
    @media (max-width: 768px) {
        .col-md-2 {
            display: none;
        }
        .col-md-10 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .btn-group .btn {
            width: 100%;
        }
    }
</style>

@endsection