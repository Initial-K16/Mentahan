@extends('layouts.header.pengajar')

@section('title', 'Tambah Tugas')

@section('content')
<div class="container-fluid py-4">
<div class="row">
    <div class="col-md-10">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Tugas
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('tugas.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="mb-4">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" id="judul" required>
                        <div class="invalid-feedback">Judul diperlukan.</div>
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" required></textarea>
                        <div class="invalid-feedback">Deskripsi diperlukan.</div>
                    </div>
                    <div class="mb-4">
                        <label for="batas_waktu" class="form-label">Batas Waktu</label>
                        <input type="date" class="form-control" name="batas_waktu" id="batas_waktu" required>
                        <div class="invalid-feedback">Batas waktu diperlukan.</div>
                    </div>
                    <div class="mb-4">
                        <label for="file" class="form-label">File Tugas (PDF, DOC, DOCX) (Opsional)</label>
                        <input type="file" class="form-control" name="file" id="file" accept=".pdf,.doc,.docx">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('deskripsi');
</script>

@section('styles')
<style>
    .form-label {
        font-weight: 600;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #007bff;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
@endsection

@endsection