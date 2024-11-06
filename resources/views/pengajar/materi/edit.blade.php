@extends('layouts.header.pengajar')

@section('title', 'Edit Materi')

@section('content')
<div class="row">
    <div class="col-md-2">
        @include('layouts.sidebar.pengajar-sidebar')
    </div>
    <div class="col-md-10">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-pencil-square me-2"></i>Edit Materi
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" id="judul" value="{{ $materi->judul }}" required>
                        <div class="invalid-feedback">Judul diperlukan.</div>
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" required>{!! $materi->deskripsi !!}</textarea>
                        <div class="invalid-feedback">Deskripsi diperlukan.</div>
                    </div>
                    <div class="mb-4">
                        <label for="file" class="form-label">File Materi (PDF, DOC, DOCX) (Opsional)</label>
                        <input type="file" class="form-control" name="file" id="file" accept=".pdf,.doc,.docx">
                        @if($materi->file)
                            <div class="mt-2">
                                <small class="text-muted">File saat ini: 
                                    <a href="{{ asset('storage/' . $materi->file) }}" target="_blank">
                                        <i class="bi bi-file-earmark-text me-1"></i>{{ basename($materi->file) }}
                                    </a>
                                </small>
                            </div>
                        @endif
                    </div>
                    <div class="mb-4">
                        <label for="url" class="form-label">URL Materi (Opsional)</label>
                        <input type="url" class="form-control" name="url" id="url" value="{{ $materi->url }}" placeholder="https://example.com">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>Update Materi
                        </button>
                        <a href="{{ route('materi.index') }}" class="btn btn-outline-secondary">
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