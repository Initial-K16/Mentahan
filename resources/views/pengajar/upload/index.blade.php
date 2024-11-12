@extends('layouts.header.pengajar')

@section('title', 'Daftar Materi/Tugas yang Di-Upload')

@section('content')
<div class="container-fluid py-4">
<div class="row">
    <div class="col-md-10">
        <!-- Table Section -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="bi bi-file-earmark-text me-2"></i>Daftar Materi/Tugas yang Di-Upload
                    </h6>
                    <a href="{{ route('upload.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i>Upload Materi Dan Tugas
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="text-center" width="5%">No</th>
                                <th scope="col" width="30%">Judul</th>
                                <th scope="col" class="text-center" width="15%">Jenis</th>
                                <th scope="col" width="30%">Kelas</th>
                                <th scope="col" class="text-center" width="20%">Waktu Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($paginatedUploads->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-inbox h1 text-muted"></i>
                                            <p class="text-muted mb-0">Belum ada materi/tugas yang diupload</p>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach($paginatedUploads as $index => $upload)
                                    @foreach($upload->kelas as $kelas)
                                        <tr>
                                            <td class="text-center">{{ ($paginatedUploads->currentPage() - 1) * 5 + $loop->parent->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="bi {{ $upload instanceof App\Models\Materi ? 'bi-file-earmark-text' : 'bi-file-earmark-pdf' }} text-primary me-2"></i>
                                                    <span class="text-wrap">{{ $upload->judul }}</span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge {{ $upload instanceof App\Models\Materi ? 'bg-info' : 'bg-success' }}">
                                                    {{ $upload instanceof App\Models\Materi ? 'Materi' : 'Tugas' }}
                                                </span>
                                            </td>
                                            <td class="text-wrap">
                                                @if ($kelas)
                                                    {{ $kelas->nama_kelas }} - {{ $kelas->jurusan }}
                                                @else
                                                    <span class="text-muted">Tidak ada kelas</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if (isset($kelas->pivot->created_at))
                                                    {{ $kelas->pivot->created_at->format('d M Y H:i') }}
                                                @else
                                                    <span class="text-muted">Tidak tersedia</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($paginatedUploads->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $paginatedUploads->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>

<style>
/* Avatar styles */
.avatar-circle {
    width: 45px;
    height: 45px;
    background-color: #0d6efd;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.img-profile {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Table styles */
.table > :not(caption) > * > * {
    padding: 1rem 0.75rem;
    vertical-align: middle;
}

.table td {
    white-space: normal;
    word-wrap: break-word;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

.badge {
    padding: 0.5em 0.8em;
    font-weight: 500;
}

.table-hover tbody tr:hover {
    background-color: rgba(0,0,0,.02);
}

/* Responsive styles */
@media (max-width: 768px) {
    .table-responsive {
        border: 0;
    }
    
    .btn-sm {
        padding: 0.2rem 0.4rem;
    }
    
    .card-header {
        padding: 0.75rem;
    }

    .table td, .table th {
        font-size: 0.85rem;
        padding: 0.75rem 0.5rem;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.4em 0.6em;
    }
    
    .text-wrap {
        min-width: 120px;
    }
}

/* Pagination custom styles */
.pagination {
    margin-bottom: 0;
}

.page-link {
    padding: 0.375rem 0.75rem;
    border-radius: 0.25rem;
    margin: 0 2px;
}

.page-item.active .page-link {
    background-color: #0d6efd;
    border -color: #0d6efd;
    color: white;
}

.page-item.disabled .page-link {
    color: #6c757d;
    background-color: #fff;
    border-color: #dee2e6;
}
</style>
@endsection