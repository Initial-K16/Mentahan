@extends('layouts.header.admin')

@section('title', 'Edit Profil Admin')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h3 class="mb-4 text-center"><i class="bi bi-person-gear"></i> Edit Profil Admin</h3>

                    <form action="{{ route('admin.profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data" id="editProfileForm">
                        @csrf
                        @method('PUT')

                        <div class="d-flex align-items-center mb-4">
                            <img id="profile-photo-preview" src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo) }}" alt="Profile Photo" class="rounded-circle me-3" width="100" height="100">
                            <div>
                                <h5 class="mb-1">Foto Profil Saat Ini</h5>
                                <p class="text-muted mb-0">Pratinjau foto profil baru akan muncul di sini</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label"><i class="bi bi-person-fill"></i> Nama</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $admin->name) }}" required placeholder="Nama Lengkap">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i> Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $admin->email) }}" required placeholder="Email Aktif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label"><i class="bi bi-lock-fill"></i> Password Baru <small>(Opsional)</small></label>
                                <input type="password" class="form-control" name="password" placeholder="Biarkan kosong jika tidak ingin mengubah">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label"><i class="bi bi-lock-fill"></i> Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Masukkan ulang password baru">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="profile_photo" class="form-label"><i class="bi bi-image-fill"></i> Foto Profil</label>
                            <input type="file" class="form-control" name="profile_photo" onchange="previewProfilePhoto(event)">
                            <small class="form-text text-muted">Unggah foto profil dengan format JPEG, PNG, atau JPG maksimal 2MB.</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Perubahan
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan SweetAlert2 CSS dan JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function previewProfilePhoto(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('profile-photo-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    document.getElementById('editProfileForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Simpan Perubahan?',
            text: "Apakah Anda yakin ingin menyimpan perubahan profil?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal',
            customClass: {
                container: 'my-swal'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menyimpan...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    customClass: {
                        container: 'my-swal'
                    }
                });
                this.submit();
            }
        });
    });

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 1500,
            showConfirmButton: false,
            customClass: {
                container: 'my-swal'
            }
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Terjadi kesalahan dalam mengubah profil!',
            footer: '{!! implode("<br>", $errors->all()) !!}',
            customClass: {
                container: 'my-swal'
            }
        });
    @endif
</script>

<style>
    .card {
        border-radius: 15px;
    }
    .form-label {
        font-weight: 600;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
    }
    .btn-outline-secondary:hover {
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
    }
    @media (max-width: 768px) {
        .col-md-8 {
            padding: 0 15px;
        }
    }
    .my-swal {
        z-index: 1060 !important;
    }
    .swal2-popup {
        font-family: inherit;
        border-radius: 15px;
    }
    .swal2-title {
        font-size: 1.5rem;
    }
    .swal2-content {
        font-size: 1rem;
    }
    .swal2-confirm {
        background-color: #007bff !important;
    }
    .swal2-cancel {
        background-color: #6c757d !important;
    }
    @media (max-width: 500px) {
        .swal2-popup {
            width: 90% !important;
            font-size: 0.8rem !important;
        }
        .swal2-title {
            font-size: 1.2rem !important;
        }
        .swal2-content {
            font-size: 0.9rem !important;
        }
        .swal2-confirm, .swal2-cancel {
            font-size: 0.8rem !important;
            padding: 0.5em 1em !important;
        }
    }
</style>
@endsection