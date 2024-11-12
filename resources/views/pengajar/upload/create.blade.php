@extends('layouts.header.pengajar')

@section('title', 'Upload Materi/Tugas')

@section('content')
<div class="container-fluid py-4">
<div class="row">
    <div class="col-md-10">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-cloud-upload me-2"></i>Upload Materi/Tugas ke Kelas
                </h5>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('upload.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="mb-4">
                        <label for="type" class="form-label">Pilih Jenis Konten</label>
                        <select name="type" id="type" class="form-select" required>
                            <option value="">-- Pilih Materi Atau Tugas --</option>
                            <option value="materi"><i class="bi bi-file-text"></i> Materi</option>
                            <option value="tugas"><i class="bi bi-clipboard-check"></i> Tugas</option>
                        </select>
                        <div class="invalid-feedback">Silakan pilih jenis konten.</div>
                    </div>

                    <div class="mb-4" id="content-select" style="display: none;">
                        <label for="content_id" class="form-label">Pilih Konten</label>
                        <select name="content_id" id="content_id" class="form-select" required>
                            <optgroup label="Materi Yang Telah Dibuat" id="materi-group">
                                <option value="">-- Pilih Materi --</option>
                                @foreach($materis as $materi)
                                    <option value="materi-{{ $materi->id }}">{{ $materi->judul }}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="Tugas Yang Telah Dibuat" id="tugas-group">
                                <option value="">-- Pilih Tugas --</option>
                                @foreach($tugas as $tug)
                                    <option value="tugas-{{ $tug->id }}">{{ $tug->judul }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <div class="invalid-feedback">Silakan pilih konten yang akan diupload.</div>
                    </div>

                    <div class="mb-4" id="kelas-select" style="display: none;">
                        <label for="kelas_id" class="form-label">Pilih Kelas</label>
                        <select name="kelas_id" id="kelas_id" class="form-select" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }} - {{ $kelas->jurusan }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Silakan pilih kelas tujuan.</div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-cloud-upload me-2"></i>Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@section('styles')
<style>
    .form-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        const contentSelect = document.getElementById('content-select');
        const kelasSelect = document.getElementById('kelas-select');
        const materiGroup = document.getElementById('materi-group');
        const tugasGroup = document.getElementById('tugas-group');

        typeSelect.addEventListener('change', function() {
            const type = this.value;
            if (type) {
                contentSelect.style.display = 'block';
                kelasSelect.style.display = 'block';
                if (type === 'materi') {
                    materiGroup.style.display = 'block';
                    tugasGroup.style.display = 'none';
                } else {
                    materiGroup.style.display = 'none';
                    tugasGroup.style.display = 'block';
                }
            } else {
                contentSelect.style.display = 'none';
                kelasSelect.style.display = 'none';
            }
        });

        // Form validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
</script>
@endsection

@endsection