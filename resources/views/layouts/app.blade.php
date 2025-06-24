<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dashboard') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        :root {
            --color-primary: #000000;
            --color-secondary: #a6a6a6;
            --color-bg: #ffffff;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--color-bg);
            color: var(--color-primary);
            margin: 0;
            padding: 0;
        }

        /* NAVBAR */
        .navbar {
            background-color: var(--color-bg);
            border-bottom: 1px solid #e0e0e0;
        }

        /* Nav Brand */
        .navbar-brand {
            font-weight: 900;
            font-size: 1.75rem;
            color: #000000 !important;
            /* Hitam tegas */
            user-select: none;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Nav Link */
        .nav-link {
            font-weight: 700;
            font-size: 1rem;
            color: #000000 !important;
            /* Hitam utama */
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: background-color 0.3s ease, color 0.3s ease;
            text-transform: uppercase;
        }

        /* Hover & Focus */
        .nav-link:hover,
        .nav-link:focus {
            background-color: #f2f2f2;
            /* Abu-abu sangat muda untuk efek hover */
            color: #a6a6a6 !important;
            /* Abu-abu sebagai aksen hover */
            outline: none;
        }

        /* Active link highlight (opsional) */
        .nav-link.active {
            color: #a6a6a6 !important;
            /* Tanda aktif, abu-abu */
            font-weight: 900;
        }


        /* MAIN CONTENT */
        main {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        /* UTILITIES */
        .btn-black {
            background-color: #000;
            color: #fff;
            border: none;
            font-weight: 600;
        }

        .btn-black:hover {
            background-color: #333;
        }
    </style>
</head>

<body>
    <div id="app">
        <!-- Header -->
        <header class="navbar navbar-expand-lg sticky-top" role="banner" aria-label="Header dengan navigasi utama">
            <div class="container d-flex align-items-center">
                <a class="navbar-brand" href="{{ route('beranda') }}" tabindex="0" aria-label="Logo FashionBrand">HYPELAY WEAR</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav gap-3">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('katalog') ? 'active' : '' }}" href="{{ route('katalog') }}">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('keranjang') ? 'active' : '' }}" href="{{ route('keranjang') }}">Keranjang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pengguna') ? 'active' : '' }}" href="{{ route('pengguna') }}">Akun</a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>