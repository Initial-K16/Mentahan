@extends('layouts.header.pengajar')

@section('title', 'Daftar Pengumpulan Tugas')

@section('content')
<div class="row">
    <div class="col-md-2">
        @include('layouts.sidebar.pengajar-sidebar')
    </div>
    <div class="col-md-10">
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5 class="mb-0 text-primary"><i class="bi bi-file-earmark-text me-2"></i>Daftar Pengumpulan Tugas</h5>
            </div>
            <div class="card-body">
                @if ($tugas->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        <i class="bi bi-exclamation-circle me-2"></i> Tidak ada pengumpulan tugas yang ditemukan.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th>Kelas & Jurusan</th>
                                    <th>Tugas</th>
                                    <th>File</th>
                                    <th>Catatan</th>
                                    <th>Tanggal Kirim</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tugas as $t)
                                    @foreach ($t->pengumpulanTugas->where('tugas_dikonfirmasi', false) as $pengumpulan)
                                        <tr>
                                            <td>{{ $pengumpulan->user->name }}</td>
                                            <td>
                                                {{ optional($pengumpulan->user->kelas->first())->nama_kelas }}
                                                @if(optional($pengumpulan->user->kelas->first())->pivot)
                                                    - {{ $pengumpulan->user->kelas->first()->pivot->jurusan }}
                                                @endif
                                            </td>
                                            <td>{{ $t->judul }}</td>
                                            <td>
                                                <a href="{{ asset('storage/pengumpulan_tugas/' . $pengumpulan->file) }}" class="btn btn-primary btn-sm" download>
                                                    Unduh
                                                </a>
                                            </td>
                                            <td>{{ $pengumpulan->catatan ?? 'Tidak ada catatan' }}</td>
                                            <td>{{ $pengumpulan->created_at->format('d F Y, H:i') }}</td>
                                            <td>
                                                <form action="{{ route('tugas.konfirmasi', $pengumpulan->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        Konfirmasi
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card-header {
        border-bottom: 2px solid #007bff;
    }
    .card-header h5 {
        color: #007bff;
    }
    .table th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }
    .table td {
        vertical-align: middle;
    }
    .btn {
        font-size: 0.875rem;
        padding: 0.25rem 0.5rem;
    }
    .alert {
        display: flex;
        align-items: center;
    }
    @media (max-width: 768px) {
        .table-responsive {
            border: 0;
        }
        .table thead {
            display: none;
        }
        .table, .table tbody, .table tr, .table td {
            display: block;
            width: 100%;
        }
        .table tr {
            margin-bottom: 15px;
            border-bottom: 2px solid #dee2e6;
        }
        .table td {
            text-align: right;
            padding-left: 50%;
            position: relative;
        }
        .table td::before {
            content: attr(data-label);
            position: absolute;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            text-align: left;
            font-weight: bold;
        }
    }
</style>
@endpush

@endsection