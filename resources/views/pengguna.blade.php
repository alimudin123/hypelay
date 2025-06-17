<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profil Akun - FashionBrand</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fff;
            padding: 2rem;
        }

        .profile-img {
            width: 200px;
            height: 200px;
            background-color: #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .nav-link {
            color: #000;
        }

        .divider {
            height: 1px;
            background: #ddd;
            margin: 2rem 0;
        }

        .edit-btn {
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    @include('layouts.header')
    @if (Auth::check())
    <div class="container">
        <!-- Profil -->
        <div class="row align-items-center">
            <div class="col-md-4 text-center">
                <div class="profile-img mb-3">
                    @if(Auth::user()->user_image)
                    <img src="{{ asset('storage/profile/' . Auth::user()->user_image) }}" alt="Foto Profil" class="img-fluid rounded-circle" style="width: 200px; height: 200px; object-fit: cover;">
                    @else
                    <span>Foto</span>
                    @endif
                </div>

                <form action="{{ route('profile.uploadImage') }}" method="POST" enctype="multipart/form-data" class="text-center">
                    @csrf
                    <div class="mb-2">
                        <input type="file" name="user_image" accept="image/*" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Unggah Foto</button>
                </form>
            </div>
            <div class="col-md-8">
                <p>Alamat: {{ Auth::user()->dataPengguna->address ?? '-' }}</p>
                <p>Nomor Telepon: {{ Auth::user()->dataPengguna->phone ?? '-' }}</p>
                <p>Kota: {{ Auth::user()->dataPengguna->city ?? '-' }}</p>
                <p>Kode Pos: {{ Auth::user()->dataPengguna->postal_code ?? '-' }}</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-success edit-btn">Edit Profil</a>
            </div>
        </div>

        <div class="divider"></div>

        <!-- Transaksi & Favorit -->
        <div>
            <h4><strong>Transaksi:</strong></h4>
            <h5><strong>Favorit:</strong></h5>
            <p><strong>Lorem: </strong>Ipsum</p>
            <p><strong>Lorem: </strong>Ipsum</p>
            <p><strong>Lorem: </strong>Ipsum</p>
            <!-- Tombol Logout -->
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
            <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
        </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>