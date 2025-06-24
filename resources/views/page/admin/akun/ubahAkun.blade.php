@extends('layouts.base_admin.base_dashboard')

@section('judul', 'Ubah Akun')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Ubah Akun</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Ubah Akun</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    @if(session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
        <strong>Berhasil!</strong> {{ session('status') }}
    </div>
    @endif

    <form method="post" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        @csrf
        <div class="col-md-4 text-center mx-auto mb-4">
            <label for="uploadImage" class="font-weight-bold d-block mb-2">Foto Profil</label>
            <div class="position-relative d-inline-block" style="width: 150px; height: 150px;">
                <img id="prevImg"
                    src="{{ $usr->user_image ? asset('storage/profile/' . $usr->user_image) : asset('vendor/adminlte3/img/user2-160x160.jpg') }}"
                    alt="Foto Profil"
                    class="rounded-circle shadow"
                    style="width: 150px; height: 150px; object-fit: cover;">

                <!-- Overlay -->
                <div class="overlay d-flex flex-column justify-content-center align-items-center"
                    onclick="document.getElementById('uploadImage').click()"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                    background-color: rgba(0, 0, 0, 0.5); border-radius: 50%;
                    cursor: pointer; opacity: 0; transition: opacity 0.3s;">
                    <div class="text-white text-center">
                        <div style="font-size: 24px;">📷</div>
                        <small>Ubah Foto</small>
                    </div>
                </div>
            </div>

            <!-- Input file tersembunyi -->
            <input type="file" name="user_image" id="uploadImage" accept="image/*"
                class="d-none @error('user_image') is-invalid @enderror" onchange="previewImage(this)">
            @error('user_image')
            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputName" class="font-weight-bold">Nama</label>
                    <input type="text" id="inputName" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama" value="{{ $usr->name }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="font-weight-bold">Email</label>
                    <input type="email" id="inputEmail" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email" value="{{ $usr->email }}" required>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password" class="font-weight-bold">Password</label>
                    <input id="password" type="password" placeholder="Kata Sandi" class="form-control @error('password') is-invalid @enderror" name="password" required>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm" class="font-weight-bold">Konfirmasi Password</label>
                    <input placeholder="Ketik ulang kata sandi" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="javascript:history.back()" class="btn btn-secondary">Batal</a>
                <input type="submit" value="Ubah Akun" class="btn btn-success float-right">
            </div>
        </div>
    </form>

</section>
<!-- /.content -->

@endsection

@section('script_footer')
@section('script_footer')
<script>
    function previewImage(input) {
        const file = input.files[0];
        if (file) {
            document.getElementById('prevImg').src = URL.createObjectURL(file);
        }
    }

    // Overlay muncul saat hover
    document.addEventListener('DOMContentLoaded', () => {
        const wrapper = document.querySelector('.position-relative.d-inline-block');
        const overlay = wrapper.querySelector('.overlay');

        wrapper.addEventListener('mouseover', () => {
            overlay.style.opacity = 1;
        });

        wrapper.addEventListener('mouseout', () => {
            overlay.style.opacity = 0;
        });
    });
</script>
@endsection

@endsection