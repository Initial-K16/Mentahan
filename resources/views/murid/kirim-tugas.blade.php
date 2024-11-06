@extends('layouts.header.murid')

@section('title', 'Kirim Tugas')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8 col-md-10 col-sm-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-paper-plane mr-2"></i>Kirim Tugas</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('murid.kirim.tugas', $tugas->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file" class="font-weight-bold text-primary">File Tugas:</label>
                            <input type="file" name="file" class="form-control" id="file" required>
                            @error('file')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="catatan" class="font-weight-bold text-primary">Catatan (Opsional):</label>
                            <textarea name="catatan" class="form-control" id="catatan" rows="3">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between mt-4"> <!-- Tambahkan margin-top di sini -->
                            <a href="{{ route('murid.murid-dashboard') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane mr-1"></i>Kirim Tugas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection