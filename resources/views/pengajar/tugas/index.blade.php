@extends('layouts.header.pengajar')

@section('title', 'Kelola Tugas')

@section('content')
<div class="container-fluid py-4">
<div class="row">
    <div class="col-md-10">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-clipboard-check me-2"></i>Kelola Tugas
                </h5>
                <a href="{{ route('tugas.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Tambah Tugas
                </a>
            </div>
            <div class="card-body table-responsive">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Batas Waktu</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($tugas->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Tugas tidak tersedia</td>
                            </tr>
                        @else
                            @foreach ($tugas as $item)
                                <tr>
                                    <td class="td-title">{{ $item->judul }}</td>
                                    <td class="td-description">{!! Str::limit($item->deskripsi, 20) !!}</td>
                                    <td>{{ $item->batas_waktu }}</td>
                                    <td class="td-file">
                                        @if ($item->file)
                                            <a href="{{ asset('storage/' . $item->file) }}" target="_blank">
                                                {{ Str::limit(basename($item->file), 15) }}
                                            </a>
                                        @else
                                            Tidak ada file
                                        @endif
                                    </td>
                                    <td class="td-action text-center">
                                        <a href="{{ route('tugas.show', $item->id) }}" class="btn btn-info btn-sm">
                                            <i class="bi bi-eye"></i> Show
                                        </a>
                                        <a href="{{ route('tugas.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                            <form action="{{ route('tugas.destroy', $item->id) }}" method="POST" onsubmit="confirmDelete(event, this)" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <!-- Menampilkan kontrol pagination -->
                <div class="d-flex justify-content-center">
                    {{ $tugas->links() }} <!-- Menampilkan link pagination -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style>
    .table-responsive {
        overflow-x: auto; /* Menambahkan scroll jika tabel terlalu lebar */
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    /* Styling untuk teks panjang */
    .td-title, .td-description, .td-file {
        max-width: 150px; /* Batasi lebar */
        overflow: hidden; /* Sembunyikan overflow */
        white-space: nowrap; /* Mencegah teks dibungkus ke baris baru */
        text-overflow: ellipsis; /* Tambahkan ellipsis (...) */
    }

    /* Untuk deskripsi, tambahkan rule untuk menyembunyikan enter */
    .td-description {
        white-space: normal; /* Izinkan pembungkusan, tetapi hilangkan enter */
        max-height: 40px; /* Batasi tinggi */
        overflow: hidden; /* Sembunyikan overflow */
        text-overflow: ellipsis; /* Tambahkan ellipsis (...) */
    }

    .td-file a {
        text-decoration: none;
        color: #007bff;
    }

    .td-action {
        text-align: center;
        white-space: nowrap; /* Mencegah tombol aksi dibungkus */
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1; /* Warna latar belakang saat hover */
    }
</style>
@endsection