@extends('layouts.header.murid')

@section('title', 'Dashboard Murid')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 mx-auto">
            <!-- Informasi Profil dan Kelas -->
            <div class="card shadow mb-4 dashboard-card">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Dashboard Murid</h2>
                    <div class="alert alert-success text-center mb-4 welcome-alert">
                        <i class="fas fa-user-circle mr-2"></i>Selamat datang, <h5 class="mb-0">{{ Auth::user()->name }}!</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card bg-light h-100 hover-effect">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-school mr-2 text-primary"></i>Kelas
                                    </h5>
                                    <p class="card-text text-info">
                                        {{ $namaKelas ?? 'Belum ada kelas yang dipilih' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card bg-light h-100 hover-effect">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-graduation-cap mr-2 text-success"></i>Jurusan
                                    </h5>
                                    <p class="card-text text-info">
                                        {{ $jurusanKelas ?? 'Tidak ada jurusan yang dipilih' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Daftar Murid -->
                    <div class="card mt-4 dashboard-card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-users mr-2"></i>Daftar Murid di Kelas Ini
                            </h5>
                        </div>
                        <div class="card-body text-center">
                            <button type="button" class="btn btn-primary btn-sm hover-effect" data-toggle="modal" data-target="#daftarMuridModal">
                                <i class="fas fa-users mr-2"></i>Lihat Daftar Murid
                            </button>
                        </div>
                    </div>

                   <!-- Card Materi dan Tugas (Gabungan) -->
<div class="card mt-4 dashboard-card">
    <div class="card-header bg-gradient-primary text-white">
        <h5 class="mb-0">
            <i class="fas fa-books mr-2"></i>Materi dan Tugas Pembelajaran
        </h5>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Kolom Materi -->
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-info hover-effect" style="border: 2px solid #17a2b8;">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-book mr-2"></i>Materi Pembelajaran
                        </h5>
                        <span class="badge badge-light">
                            {{ $materiTerbaru->count() + $materiLainnya->count() }} Materi
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <button type="button" class="btn btn-info btn-sm hover-effect text-white" data-toggle="modal" data-target="#materiModal">
                                <i class="fas fa-book mr-2"></i>Lihat Semua Materi
                            </button>
                        </div>
                        <!-- Preview Materi Terbaru -->
                        <div class="recent-items">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-clock mr-2"></i>Materi Terbaru
                            </h6>
                            @if($materiTerbaru->isNotEmpty())
                                @foreach($materiTerbaru->take(2) as $materi)
                                    <div class="alert alert-info fade show mb-2 py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <i class="fas fa-file-alt fa-lg text-info"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $materi->judul }}</h6>
                                                <small>{{ $materi->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center text-muted">
                                    <i class="fas fa-info-circle mb-2"></i>
                                    <p class="mb-0">Belum ada materi terbaru</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Tugas -->
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-success hover-effect" style="border: 2px solid #28a745;">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-clipboard-list mr-2"></i>Tugas
                        </h5>
                        <span class="badge badge-light">
                            {{ $tugas->count() }} Tugas
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <button type="button" class="btn btn-success btn-sm hover-effect" data-toggle="modal" data-target="#tugasModal">
                                <i class="fas fa-clipboard-list mr-2"></i>Lihat Semua Tugas
                            </button>
                        </div>

                        <!-- Preview Tugas Terbaru -->
                        <div class="recent-items">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-clock mr-2"></i>Tugas Terbaru
                            </h6>
                            @if($tugas->isNotEmpty())
                                @foreach($tugas->take(2) as $tugasItem)
                                    <div class="alert alert-success fade show mb-2 py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <i class="fas fa-tasks fa-lg text-success"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $tugasItem->judul }}</h6>
                                                <small>Deadline: {{ \Carbon\Carbon::parse($tugasItem->deadline)->format('d M Y') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center text-muted">
                                    <i class="fas fa-info-circle mb-2"></i>
                                    <p class="mb-0">Belum ada tugas</p>
                                </div>
                            @endif
                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Daftar Murid -->
            <div class="modal fade" id="daftarMuridModal" tabindex="-1" role="dialog" aria-labelledby="daftarMuridModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="daftarMuridModalLabel">
                                <i class="fas fa-users mr-2"></i>Daftar Murid di Kelas
                            </h5>
                        </div>
                        <div class="modal-body">
                            @if($daftarMurid->isEmpty())
                                <div class="alert alert-warning text-center">
                                    <i class="fas fa-exclamation-triangle mr -2"></i>
                                    Tidak ada murid yang terdaftar.
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="text-center">No</th>
                                                <th scope="col" class="text-center">Foto</th>
                                                <th scope="col">Nama Murid</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($daftarMurid as $murid)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">
                                                        <img src="{{ $murid->profile_photo ? asset('storage/profile_photos/' . $murid->profile_photo) : asset('default_profile.png') }}" 
                                                             alt="Profile Photo " 
                                                             class="rounded-circle" 
                                                             width="50">
                                                    </td>
                                                    <td>
                                                        <span class="font-weight-bold">{{ $murid->name }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times mr-1"></i>Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Materi -->
            <div class="modal fade" id="materiModal" tabindex="-1" role="dialog" aria-labelledby="materiModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title" id="materiModalLabel">
                                <i class="fas fa-book mr-2"></i>Materi Pembelajaran
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- Materi Terbaru -->
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 border-primary">
                                        <div class="card-header bg-primary text-white">
                                            <h5 class="mb-0">
                                                <i class="fas fa-book mr-2"></i>Materi Terbaru
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            @if($materiTerbaru->isNotEmpty())
                                                <div class="list-group">
                                                    @foreach($materiTerbaru as $materi)
                                                        <div class="list-group-item list-group-item-action mb-2 border-0 shadow-sm">
                                                            <div class="d-flex align-items-center">
                                                                <img src="{{ $materi->pengajar->profile_photo ? asset('storage/profile_photos/' . $materi->pengajar->profile_photo) : asset('default_profile.png') }}" alt="Profile Photo" class="rounded-circle" width="50" height="50" style="margin-right: 10px;">
                                                                <div>
                                                                    <h6 class="mb-1">{{ $materi->judul }}</h6>
                                                                    <p class="text-muted mb-1 small">Oleh: {{ $materi->pengajar->name }}</p>
                                                                    <a href="{{ route('murid.lihat-materi', $materi->id) }}" class="btn btn-sm btn-outline-primary mt-2">
                                                                        <i class="fas fa-eye mr-1"></i>Lihat Materi
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="text-center text-muted py-3">
                                                    <i class="fas fa-info-circle fa-2x mb-2"></i>
                                                    <p>Tidak ada materi terbaru.</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Materi Lainnya -->
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 border-secondary">
                                        <div class="card-header bg-secondary text-white">
                                            <h5 class="mb-0">
                                                <i class="fas fa-book-open mr-2"></i>Materi Lainnya
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            @if($materiLainnya->isNotEmpty())
                                                <div class="list-group">
                                                    @foreach($materiLainnya as $materi)
                                                        <div class=" list-group-item list-group-item-action mb-2 border-0 shadow-sm">
                                                            <div class="d-flex align-items-center">
                                                                <img src="{{ $materi->pengajar->profile_photo ? asset('storage/profile_photos/' . $materi->pengajar->profile_photo) : asset('default_profile.png') }}" alt="Profile Photo" class="rounded-circle" width="50" height="50" style="margin-right: 10px;">
                                                                <div>
                                                                    <h6 class="mb-1">{{ $materi->judul }}</h6>
                                                                    <p class="text-muted mb-1 small">Oleh: {{ $materi->pengajar->name }}</p>
                                                                    <a href="{{ route('murid.lihat-materi', $materi->id) }}" class="btn btn-sm btn-outline-secondary mt-2">
                                                                        <i class="fas fa-eye mr-1"></i>Lihat Materi
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="text-center text-muted py-3">
                                                    <i class="fas fa-info-circle fa-2x mb-2"></i>
                                                    <p>Tidak ada materi lainnya.</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times mr-1"></i>Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Tugas -->
            <div class="modal fade" id="tugasModal" tabindex="-1" role="dialog" aria-labelledby="tugasModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="tugasModalLabel">
                                <i class="fas fa-clipboard-list mr-2"></i>Tugas
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- Daftar Tugas -->
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 border-success">
                                        <div class="card-header bg-success text-white">
                                            <h5 class="mb-0">
                                                <i class="fas fa-book mr-2"></i>Daftar Tugas
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            @if($tugas->isNotEmpty())
                                                <div class="list-group">
                                                    @foreach($tugas as $tugasItem)
                                                        <div class="list-group-item list-group-item-action mb-2 border-0 shadow-sm">
                                                            <div class="d-flex align-items-center">
                                                                <img src="{{ $tugasItem->pengajar->profile_photo ? asset('storage/profile_photos/' . $tugasItem->pengajar->profile_photo) : asset('default_profile.png') }}" alt="Profile Photo" class="rounded-circle" width="50" height="50" style="margin-right: 10px;">
                                                                <div>
                                                                    <h6 class="mb-1">{{ $tugasItem->judul }}</h6>
                                                                    <p class="text-muted mb-1 small">Oleh: {{ $tugasItem->pengajar->name }}</p>
                                                                    <a href="{{ route('murid.lihat-tugas', $tugasItem->id) }}" class="btn btn-sm btn-outline-success mt-2">
                                                                        <i class="fas fa-clipboard-list mr-1"></i>Lihat Tugas
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="text-center text-muted py-3">
                                                    <i class="fas fa-clipboard-check fa-2x mb-2"></i>
                                                    <p>Tidak ada tugas yang tersedia saat ini.</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Tugas yang Telah Dikonfirmasi -->
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 border-warning">
                                        <div class="card-header bg-warning text-white">
                                            <h5 class="mb-0">
                                                <i class="fas fa-check-circle mr-2"></i>Tugas yang Telah Dikonfirmasi
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            @if ($tugasDikonfirmasi->isNotEmpty())
                                                <div class="alert alert-success">
                                                    <strong>Tugas yang Dikonfirmasi:</strong>
                                                    <ul>
                                                        @foreach($tugasDikonfirmasi as $tugasItem)
                                                            <li>
                                                                {{ $tugasItem->judul }} - 
                                                                <small class="text-muted">Dikonfirmasi oleh: {{ $tugasItem->pengajar->name }}</small>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @else
                                                <div class="alert alert-warning">
                                                    <strong>Tidak ada tugas yang telah dikonfirmasi.</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times mr-1"></i>Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    
    .dashboard-card .card-body {
        padding: 1.25rem;
    }

    .dashboard-card .alert {
        padding: 0.5rem 1rem;
    }

    .dashboard-card .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }

    .dashboard-card .recent-items h6 {
        font-size: 0.9rem;
    }

    .dashboard-card .recent-items .alert h6 {
        font-size: 0.95rem;
    }

    @media (min-width: 768px) {
        .dashboard-card .row {
            margin-left: -10px;
            margin-right: -10px;
        }
        .dashboard-card .col-md-6 {
            padding-left: 10px;
            padding-right: 10px;
        }
    }

    
    /* General Styles */
    body {
        background-color: #f8f9fa;
    }
    
    .card {
        border: none;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        transition: transform 0.2s ease-in-out;
    }
    
    .card:hover {
        transform: translateY(-3px);
    }
    
    /* Dashboard Cards */
    .dashboard-card {
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    
    .dashboard-card .card-body {
        padding: 1.5rem;
    }
    
    /* Welcome Alert */
    .welcome-alert {
        background: linear-gradient(45deg, #28a745, #20c997);
        border: none;
        color: white;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(40, 167, 69, 0.2);
    }
    
    /* Modal Styles */
    .modal-content {
        border: none;
        border-radius: 15px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .modal-header {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        padding: 1.5rem;
    }
    
    .modal-body {
        padding: 1.5rem;
        max-height: 70vh;
        overflow-y: auto;
    }
    
    /* Buttons */
    .btn {
        border-radius: 10px;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    /* Table Styles */
    .table {
        background: white;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .table thead th {
        border-top: none;
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
    }
    
    /* List Group Items */
    .list-group-item {
        border-radius: 10px !important;
        margin-bottom: 0.75rem;
        transition: all 0.2s ease;
    }
    
    .list-group-item:hover {
        transform: translateX(5px);
        background-color: #f8f9fa;
    }
    
    /* Profile Images */
    .rounded-circle {
        border: 3px solid white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    /* Custom Scrollbar */
    .modal-body::-webkit-scrollbar {
        width: 8px;
    }
    
    .modal-body::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .modal-body::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    
    .modal-body::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    
    /* Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity:  1; transform: translateY(0); }
    }
    
    .card {
        animation: fadeIn 0.5s ease-out;
    }
    
    /* Status Badges */
    .badge {
        padding: 0.5em 1em;
        border-radius: 30px;
        font-weight: 500;
    }
    
    /* Modal Backdrop */
    .modal-backdrop.show {
        opacity: 0.7;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .modal-dialog {
            margin: 0.5rem;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        .btn {
            padding: 0.4rem 1rem;
        }
    }


    /* Gradient Background */
.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
}

/* Card Animations */
.hover-effect {
    transition: all 0.3s ease;
}

.hover-effect:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* Alert Styling */
.alert {
    border-radius: 10px;
    border: none;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.recent-items .alert {
    transition: all 0.3s ease;
}

.recent-items .alert:hover {
    transform: translateX(5px);
}

/* Badge Styling */
.badge {
    font-size: 0.8rem;
    padding: 0.5em 1em;
    border-radius: 30px;
}

/* Icon Styling */
.fa-2x {
    font-size: 1.5rem;
}

/* Button Improvements */
.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    border-radius: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Card Header Improvements */
.card-header {
    padding: 1rem 1.5rem;
    border-bottom: none;
}
</style>
    
<script>
    $(document).ready(function() {
        // Animate elements on page load
        $('.card').each(function(index) {
            $(this).css({
                'animation-delay': (index * 0.1) + 's'
            });
        });
    
        // Smooth scroll for modal content
        $('.modal').on('shown.bs.modal', function() {
            $(this).find('.modal-body').animate({
                scrollTop: 0
            }, 300);
        });
    
        // Hover effects
        $('.hover-effect').hover(
            function() {
                $(this).addClass('shadow-lg');
            },
            function() {
                $(this).removeClass('shadow-lg');
            }
        );
    });
</script>
@endsection