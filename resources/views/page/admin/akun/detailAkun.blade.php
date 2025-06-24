@extends('layouts.base_admin.base_dashboard')
@section('judul', 'Detail Akun')

@section('content')
<style>
    .profile-container {
        position: relative;
        width: 220px;
        height: 220px;
        margin: 0 auto;
    }

    .profile-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #ccc;
        transition: 0.3s ease;
    }

    .upload-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: 0.3s ease;
        cursor: pointer;
        text-align: center;
        padding: 10px;
    }

    .profile-container:hover .upload-overlay {
        opacity: 1;
    }

    .upload-overlay input[type="file"] {
        display: none;
    }

    .upload-icon {
        font-size: 1.2rem;
    }
</style>

<div class="container py-4">
    <div class="row">
        <div class="col-md-4 text-center">
            <div class="profile-container mb-3">
                @if($user->user_image)
                <img src="{{ asset('storage/profile/' . $user->user_image) }}" alt="Foto Profil Pengguna">
                @else
                <img src="{{ asset('vendor/adminlte3/img/user2-160x160.jpg') }}" alt="Foto Default">
                @endif

            </div>

            <form id="uploadForm" action="{{ route('profile.uploadImage') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" id="uploadImage" name="user_image" accept="image/*" class="d-none" onchange="document.getElementById('uploadForm').submit();">
            </form>
        </div>

        <div class="col-md-8">
            <h4><strong>{{ $user->name }}</strong></h4>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Alamat:</strong> {{ $user->dataPengguna->address ?? '-' }}</p>
            <p><strong>Kecamatan:</strong> {{ $user->dataPengguna->district ?? '-' }}</p>
            <p><strong>Kota:</strong> {{ $user->dataPengguna->city ?? '-' }}</p>
            <p><strong>Provinsi:</strong> {{ $user->dataPengguna->province ?? '-' }}</p>
            <p><strong>Nomor Telepon:</strong> {{ $user->dataPengguna->phone ?? '-' }}</p>
            <p><strong>Kode Pos:</strong> {{ $user->dataPengguna->postal_code ?? '-' }}</p>
            <a href="{{ route('akun.edit', ['id' => $user->id]) }}" class="btn btn-success">Edit Profil</a>
            <hr>
        </div>
    </div>
</div>
@endsection