@extends('layouts.header.murid')

@section('title', 'Edit Tugas')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8 col-md-10 col-sm-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-edit mr-2"></i>Edit Tugas</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('murid.update-tugas', $pengumpulan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="file" class="font-weight-bold">File Tugas:</label>
                            <input type="file" name="file" class="form-control">
                            <span class="text-muted">Biarkan kosong jika tidak ingin mengganti file.</span>
                            @if($pengumpulan->file)
                                <p class="mt-2">File saat ini: <a href="{{ Storage::url($pengumpulan->file) }}" target="_blank">{{ basename($pengumpulan->file) }}</a></p>
                            @else
                                <p class="mt-2">Tidak ada file yang diupload sebelumnya.</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="catatan" class="font-weight-bold">Catatan:</label>
                            <textarea name="catatan" id="catatan" class="form-control" rows="3">{{ old('catatan', $pengumpulan->catatan ?? '') }}</textarea>
                            <span class="text-muted">Edit catatan jika diperlukan.</span>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('murid.murid-dashboard') }}" class="btn btn-secondary mb-2 mb-md-0">
                                <i class="fas fa-arrow-left mr-1"></i>Kembali ke Dashboard
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane mr-1"></i>Update Tugas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection