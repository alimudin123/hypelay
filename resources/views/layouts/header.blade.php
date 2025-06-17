<!-- Header -->
<header class="navbar navbar-expand-lg navbar-light bg-white sticky-top border-bottom py-3" role="banner" aria-label="Header dengan navigasi utama">
    <div class="container d-flex align-items-center">
        <a class="navbar-brand" href="#" tabindex="0" aria-label="Logo FashionBrand">HYPELAY WEAR</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="material-icons">menu</span>
        </button>
        <!-- Navbar items only (no search) -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav gap-4">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('beranda') }}" tabindex="0">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('katalog') }}" tabindex="0">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('keranjang') }}" tabindex="0">Keranjang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pengguna') }}" tabindex="0">Akun</a>
                </li>
            </ul>
        </div>
    </div>
</header>