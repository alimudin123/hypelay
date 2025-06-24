<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profil Akun - FashionBrand</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #ffffff;
            font-family: 'Inter', sans-serif;
            color: #000000;
        }

        .profile-container {
            width: 150px;
            height: 150px;
            position: relative;
            margin: auto;
        }

        .upload-overlay {
            transition: all 0.3s ease;
            opacity: 0;
        }

        .profile-container:hover .upload-overlay {
            opacity: 1;
        }

        .divider {
            height: 1px;
            background-color: #a6a6a6;
            margin: 2rem 0;
        }

        .btn-custom {
            background-color: #000000;
            color: #ffffff;
            border: none;
        }

        .btn-custom:hover {
            background-color: #a6a6a6;
            color: #000000;
        }

        .btn-outline-custom {
            border: 1px solid #000000;
            color: #000000;
        }

        .btn-outline-custom:hover {
            background-color: #a6a6a6;
            color: #000000;
            border-color: #a6a6a6;
        }
    </style>
</head>

<body>
    @include('layouts.app')

    @if (Auth::check())
    <div class="container py-5">
        <!-- Profil -->
        <div class="row align-items-center">
            <div class="col-md-4 text-center">
                <div class="profile-container mb-3">
                    @if(Auth::user()->user_image)
                    <img src="{{ asset('storage/profile/' . Auth::user()->user_image) }}" alt="Foto Profil Pengguna" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                    <img src="{{ asset('vendor/adminlte3/img/user2-160x160.jpg') }}" alt="Foto Default" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    @endif

                    <div class="upload-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center bg-dark bg-opacity-50 text-white rounded-circle"
                        style="cursor: pointer;" onclick="document.getElementById('uploadImage').click()">
                        <div>
                            <div class="mb-1 fs-4">📷</div>
                            <small>Ubah Foto</small>
                        </div>
                    </div>
                </div>

                <form id="uploadForm" action="{{ route('profile.uploadImage') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="uploadImage" name="user_image" accept="image/*" class="d-none" onchange="document.getElementById('uploadForm').submit();">
                </form>
            </div>

            <div class="col-md-8">
                <p><strong>Alamat:</strong> {{ Auth::user()->dataPengguna->address ?? '-' }}</p>
                <p><strong>Nomor Telepon:</strong> {{ Auth::user()->dataPengguna->phone ?? '-' }}</p>
                <p><strong>Kecamatan:</strong> {{ Auth::user()->dataPengguna->district ?? '-' }}</p>
                <p><strong>Kota:</strong> {{ Auth::user()->dataPengguna->city ?? '-' }}</p>
                <p><strong>Provinsi:</strong> {{ Auth::user()->dataPengguna->province ?? '-' }}</p>
                <p><strong>Kode Pos:</strong> {{ Auth::user()->dataPengguna->postal_code ?? '-' }}</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-custom mt-3">Edit Profil</a>
            </div>
        </div>

        <div class="divider"></div>

        <!-- Transaksi & Logout -->
        <div>
            <h4 class="mb-3"><strong>Transaksi</strong></h4>
            <a href="{{ route('transaksi') }}" class="btn btn-outline-custom mb-3">Lihat Riwayat Transaksi</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger mt-4">Logout</button>
            </form>
        </div>
    </div>
    @else
    <div class="d-flex justify-content-center align-items-center" style="height: 60vh;">
        <div class="text-center">
            <h4 class="text-danger fw-bold mb-3">Anda belum login.</h4>
            <a href="{{ route('login') }}" class="btn btn-dark me-2">Login</a>
        </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>