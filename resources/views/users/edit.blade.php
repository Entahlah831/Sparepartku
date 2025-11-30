@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="container" style="max-width: 800px;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Profil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
        </ol>
    </nav>

    @if(session('success'))
        <div class="alert alert-success fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Update Informasi Akun</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update') }}" method="POST">
                @csrf
                @method('PUT') <h6 class="text-primary mb-3">Data Pribadi</h6>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
                </div>

                <hr class="my-4">

                <h6 class="text-primary mb-3">Ganti Password <small class="text-muted fw-normal">(Kosongkan jika tidak ingin mengganti)</small></h6>
                
                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter">
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan 💾</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection