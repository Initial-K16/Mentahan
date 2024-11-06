@extends('layouts.header.pengajar')

@section('title', 'Edit Tugas')

@section('content')
<div class="row">
    <div class="col-md-2">
        @include('layouts.sidebar.pengajar-sidebar')
    </div>
    <div class="col-md-10">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-pencil-square me-2"></i>Edit Tugas
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('tugas.update', $tugas->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" id="judul" value="{{ $tugas->judul }}" required>
                        <div class="invalid-feedback">Judul diperlukan.</div>
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi">{!! $tugas->deskripsi !!}</textarea>
                        <div class="invalid-feedback">Deskripsi diperlukan.</div>
                    </div>
                    <div class="mb-4">
                        <label for="batas_waktu" class="form-label">Batas Waktu</label>
                        <input type="date" class="form-control" name="batas_waktu" id="batas_waktu" value="{{ $tugas->batas_waktu }}" required>
                        <div class="invalid-feedback">Batas waktu diperlukan.</div>
                    </div>
                    <div class="mb-4">
                        <label for="file" class="form-label">File Tugas (PDF, DOC, DOCX) (Opsional)</label>
                        <input type="file" class="form-control" name="file" id="file" accept=".pdf,.doc,.docx">
                        @if($tugas->file)
                            <div class="mt-2">
                                <small class="text-muted">File saat ini: 
                                    <a href="{{ asset('storage/' . $tugas->file) }}" target="_blank">
                                        <i class="bi bi-file-earmark-text me-1"></i>{{ basename($tugas->file) }}
                                    </a>
                                </small>
                            </div>
                        @endif
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>Update Tugas
                        </button>
                        <a href="{{ route('tugas.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('deskripsi');

    // Form validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>


@push('styles')
<style>
    .form-label {
        font-weight: 600;
    }
    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        border-color: #86b7fe;
    }
    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }
    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }
</style>
@endpush

@endsection