@extends('layouts.header.murid')

@section('title', 'Detail Tugas')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8 col-md-10 col-sm-12">
            <div class="card shadow-lg border-0 rounded-lg">
                <!-- Card Header dengan gradien biru -->
                <div class="card-header py-3" style="background: linear-gradient(45deg, #4e73df, #224abe);">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 font-weight-bold text-white">
                            <i class="fas fa-tasks mr-2"></i>Detail Tugas
                        </h4>
                        <div class="bg-white px-3 py-2 rounded">
                            @php
                                $now = \Carbon\Carbon::now();
                                $batasWaktu = \Carbon\Carbon::parse($tugas->batas_waktu);
                                $status = $now->lte($batasWaktu) ? 'Aktif' : 'Berakhir';
                            @endphp
                            <span class="text-{{ $now->lte($batasWaktu) ? 'primary' : 'danger' }} font-weight-bold">
                                <i class="fas {{ $now->lte($batasWaktu) ? 'fa-clock' : 'fa-calendar-times' }} mr-2"></i>
                                {{ $status }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                <!-- Informasi Pengajar -->
                <div class="bg-white rounded-lg p-4 mb-4 border border-primary shadow-sm">
                    <h5 class="font-weight-bold mb-3 text-primary">
                        <i class="fas fa-user-tie mr-2"></i>Informasi Pengajar
                    </h5>
                    <div class="row align-items-center">
                        <div class="col-auto pr-4">
                            <img src="{{ $tugas->pengajar->profile_photo ? asset('storage/profile_photos/' . $tugas->pengajar->profile_photo) : asset('default_profile.png') }}" 
                                alt="Profile Photo" 
                                class="rounded-circle"
                                style="width: 70px; height: 70px; object-fit: cover; border: 3px solid #4e73df;">
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <span class="text-muted small d-block mb-1">Nama Pengajar:</span>
                                <div class="h6 font-weight-bold mb-0">{{ $tugas->pengajar->name }}</div>
                            </div>
                            <div>
                                <span class="text-muted small d-block mb-1">Mata Pelajaran:</span>
                                <div class="h6 mb-0">{{ $mapel->nama }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- Detail Tugas -->
                    <div class="bg-white rounded-lg p-3 mb-3 border border-primary shadow-sm">
                        <h5 class="font-weight-bold mb-2 text-primary">
                            <i class="fas fa-info-circle mr-2"></i>Detail Tugas
                        </h5>
                        
                        <div class="mb-3">
                            <label class="text-muted small">Judul Tugas</label>
                            <div class="h6 mb-0">{{ $tugas->judul }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted small">Deskripsi</label>
                            <div class="border rounded p-2 bg-light" style="max-height: 150px; overflow-y: auto;">
                                {!! ($tugas->deskripsi) !!}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="text-muted small d-block">Tanggal Dibuat</label>
                                <small class="text-dark">
                                    <i class="far fa-calendar-alt text-primary"></i>
                                    {{ \Carbon\Carbon::parse($tugas->created_at)->format('d/m/Y H:i') }}
                                </small>
                            </div>
                            <div class="col-6">
                                <label class="text-muted small d-block">Batas Waktu</label>
                                <small class="text-{{ $now->lte($batasWaktu) ? 'primary' : 'danger' }}">
                                    <i class="far fa-clock"></i>
                                    {{ \Carbon\Carbon::parse($tugas->batas_waktu)->format('d/m/Y H:i') }}
                                </small>
                            </div>
                        </div>

                        <!-- File Tugas -->
                        @if ($tugas->file)
                            <div class="mb-3">
                                <label class="text-muted small">File Tugas</label>
                                <div class="d-flex align-items-center bg-light border rounded p-2">
                                    <i class="fas fa-file-alt text-primary mr-2"></i>
                                    <div class="flex-grow-1 text-truncate mr-2">
                                        <small>{{ basename($tugas->file) }}</small>
                                    </div>
                                    <a href="{{ asset('storage/' . $tugas->file) }}" 
                                    class="btn btn-primary btn-sm" 
                                    download>
                                        <i class="fas fa-download mr-1"></i>Unduh
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="mb-3">
                                <label class="text-muted small">File Tugas</label>
                                <div class="text-muted small">
                                    <i class="fas fa-info-circle mr-2"></i>Tidak ada file yang dilampirkan
                                </div>
                            </div>
                        @endif

                        <!-- Status Pengerjaan -->
                        <div>
                            <label class="text-muted small">Status Pengerjaan</label>
                            <div class="progress" style="height: 20px;">
                                @if ($pengumpulan)
                                    @if ($pengumpulan->tugas_dikonfirmasi == 1)
                                        <div class="progress-bar bg-primary" style="width: 100%">
                                            <small><i class="fas fa-check mr-1"></i>Selesai</small>
                                        </div>
                                    @else
                                        <div class="progress-bar bg-primary" style="width: 50%">
                                            <small><i class="fas fa-clock mr-1"></i>Menunggu Konfirmasi</small>
                                        </div>
                                    @endif
                                @else
                                    <div class="progress-bar bg-danger" style="width: 100%">
                                        <small><i class="fas fa-times mr-1"></i>Belum Dikerjakan</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Navigasi -->
                     <div class="bg-white rounded-lg p-4 border border-primary shadow-sm">
                        @if ($pengumpulan && $pengumpulan->tugas_dikonfirmasi == 0)
                             <div class="alert alert-info mb-4" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-clock fa-lg mr-3"></i>
                                    <span>Tugas Anda sedang dalam proses pengecekan oleh pengajar</span>
                                </div>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <a href="{{ route('murid.murid-dashboard') }}" class="btn btn-secondary mb-2 mb-md-0">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </a>

                            @if ($pengumpulan)
                                @if ($pengumpulan->tugas_dikonfirmasi == 0)
                                     <a href="{{ route('murid.edit-tugas', $pengumpulan->id) }}" class="btn btn-primary mb-2 mb-md-0">
                                        <i class="fas fa-edit mr-2"></i>Edit Tugas
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('murid.kirim-tugas', $tugas->id) }}" class="btn btn-primary mb-2 mb-md-0">
                                    <i class="fas fa-paper-plane mr-2"></i>Kirim Tugas
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection