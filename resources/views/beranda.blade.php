<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Website E-Commerce Fashion - Desktop View (Bootstrap 5)</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #000000;
        }

        /* Search */
        .search-input {
            max-width: 480px;
            border-radius: 2rem !important;
            border: 2px solidrgb(0, 0, 0) !important;
            /* Abu-abu soft */
            padding-left: 3rem !important;
            height: 42px;
            font-size: 1rem;
            background-color: #ffffff;
            color: #000000;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .search-input::placeholder {
            color: #a6a6a6;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .search-input:focus {
            border-color: #000000 !important;
            /* Hitam saat fokus */
            box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.1) !important;
            background-color: #ffffff;
            color: #000000;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #000000;
            /* Ikon hitam */
            pointer-events: none;
            font-size: 24px;
        }

        /* Hero */
        .hero-img {
            border-radius: 1rem;
            object-fit: cover;
            width: 100%;
            aspect-ratio: 21 / 9;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .hero-img:hover,
        .hero-img:focus {
            transform: scale(1.05);
            outline-offset: 4px;
        }

        /* CTA Button */
        .btn-cta {
            background-color: #a6a6a6;
            color: #000000;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 5.75rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 1.75rem 5rem;
            border: none;
            border-radius: 2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.35);
            user-select: none;
            display: inline-block;
            text-align: center;
        }

        /* Hover */
        .btn-cta:hover {
            background-color: #8c8c8c;
            transform: translateY(-3px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.4);
        }

        /* Fokus */
        .btn-cta:focus {
            outline: none;
            box-shadow: 0 0 0 4px #00000055;
        }

        /* Grid Beranda */
        .gambar-beranda {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(2, 200px);
            gap: 1rem;
        }

        .gambar-beranda .item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .item-1 {
            grid-column: 1 / 2;
            grid-row: 1 / 3;
        }

        .item-2 {
            grid-column: 2 / 3;
            grid-row: 1 / 2;
        }

        .item-3 {
            grid-column: 3 / 5;
            grid-row: 1 / 2;
        }

        .item-4 {
            grid-column: 2 / 5;
            grid-row: 2 / 3;
        }

        /* Carousel */
        .products-carousel-wrapper {
            position: relative;
            margin-bottom: 2rem;
        }

        .products-carousel {
            overflow-x: auto;
            white-space: nowrap;
            padding-bottom: 8px;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        .product-card {
            display: inline-block;
            width: 220px;
            border-radius: 1rem;
            border: 1px solid #d1d5db;
            margin-right: 1.5rem;
            background: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: box-shadow 0.3s ease;
            cursor: pointer;
            vertical-align: top;
            user-select: none;
        }

        .product-card:hover,
        .product-card:focus-within {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            outline: none;
        }

        .product-img-wrapper {
            height: 180px;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            overflow: hidden;
        }

        .product-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-img-wrapper img {
            transform: scale(1.08);
        }

        .product-label {
            padding: 0.75rem 1rem;
            font-weight: 600;
            font-size: 1rem;
            color: #000000;
            text-align: center;
        }

        /* Carousel Buttons */
        .carousel-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #000000;
            border: none;
            border-radius: 50%;
            width: 44px;
            height: 44px;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            display: flex;
            justify-content: center;
            align-items: center;
            user-select: none;
            transition: background-color 0.3s ease;
            z-index: 10;
            cursor: pointer;
        }

        .carousel-nav-btn:hover,
        .carousel-nav-btn:focus {
            background-color: #333333;
            outline: none;
        }

        .carousel-nav-left {
            left: 0;
        }

        .carousel-nav-right {
            right: 0;
        }

        /* Footer */
        footer {
            background-color: #f3f4f6;
            padding: 3rem 1rem;
        }

        /* Footer Slider */
        .footer-promo-slider {
            overflow: hidden;
            border-radius: 1rem;
            margin-bottom: 3rem;
            position: relative;
        }

        .footer-promo-track {
            display: flex;
            gap: 1rem;
            transition: transform 0.4s ease;
        }

        .footer-promo-slide {
            flex: 0 0 auto;
            width: 360px;
            height: 160px;
            border-radius: 1rem;
            background-color: rgb(0, 0, 0);
            color: rgb(255, 255, 255);
            font-family: 'Bebas Neue', sans-serif;
            font-weight: 600;
            font-size: 1.75rem;
            display: flex;
            justify-content: center;
            align-items: center;
            user-select: none;
            cursor: default;
            border: 2px solid #000000;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .footer-promo-slide:hover,
        .footer-promo-slide:focus {
            transform: scale(1.03);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
            outline: none;
        }


        /* Footer Columns */
        .footer-column h3 {
            color: #000000;
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .footer-column p {
            font-size: 1rem;
            color: #4b4b4b;
            margin-bottom: 1rem;
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-column ul li {
            margin-bottom: 0.5rem;
        }

        .footer-column ul li a {
            font-weight: 600;
            color: #4b4b4b;
            transition: color 0.3s ease;
            text-decoration: none;
        }

        .footer-column ul li a:hover,
        .footer-column ul li a:focus {
            color: #a6a6a6;
            outline: none;
        }

        /* CTA Join */
        .join-cta-button {
            padding: 0.6rem 2.5rem;
            background-color: #000000;
            border-radius: 2rem;
            color: #ffffff;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            transition: background-color 0.3s ease;
            user-select: none;
            cursor: pointer;
        }

        .join-cta-button:hover,
        .join-cta-button:focus {
            background-color: #333333;
            outline: none;
        }

        /* Social Icons */
        .footer-social {
            margin-top: 1.5rem;
            display: flex;
            gap: 1rem;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background-color: #000000;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #ffffff;
            transition: background-color 0.3s ease;
            font-size: 1.5rem;
            text-decoration: none;
            cursor: pointer;
        }

        .social-icon:hover,
        .social-icon:focus {
            background-color: #4a4a4a;
            outline: none;
        }

        /* Accessibility */
        :focus-visible {
            outline: 3px solid #a6a6a6;
            outline-offset: 3px;
        }

        @media (max-width: 576px) {
            .btn-cta {
                font-size: 1.25rem;
                padding: 1rem 2rem;
            }
        }
    </style>

</head>

<body>
    @include('layouts.app')
    <main>
        <div class="d-flex justify-content-center my-4" role="search" aria-label="Pencarian produk utama">
            <form class="position-relative w-100" style="max-width: 480px;">
                <span class="material-icons search-icon" aria-hidden="true">search</span>
                <input class="form-control search-input" type="search" placeholder="Cari produk..." aria-label="Cari produk" />
            </form>
        </div>

        <!-- Beranda -->
        <section id="home" class="py-5" aria-label="Halaman Beranda" tabindex="-1" style="outline:none;">
            <div class="container">
                <div class="gambar-beranda">
                    <div class="item item-1">
                        <img src="{{ asset('storage/beranda/A1.png') }}" alt="Banner Diskon Spesial" />
                    </div>
                    <div class="item item-2">
                        <img src="{{ asset('storage/beranda/A2.png') }}" alt="Banner Diskon Spesial" />
                    </div>
                    <div class="item item-3">
                        <img src="{{ asset('storage/beranda/A3.png') }}" alt="Banner Diskon Spesial" />
                    </div>
                    <div class="item item-4">
                        <img src="{{ asset('storage/beranda/A4.png') }}" alt="Banner Diskon Spesial" />
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('katalog') }}" class="btn btn-cta" role="button" aria-label="Tombol aksi Belanja">
                        Belanja Sekarang
                    </a>
                </div>
                <div class="products-carousel-wrapper mt-5 position-relative">
                    <button class="carousel-nav-btn carousel-nav-left" id="btn-scroll-left" aria-label="Gulir ke kiri">
                        <span class="material-icons">chevron_left</span>
                    </button>

                    <div class="products-carousel" id="product-list" role="region" aria-label="Produk Terbaru">
                        @foreach ($produks as $produk)
                        <div class="product-card" tabindex="0">
                            <div class="product-img-wrapper rounded-top overflow-hidden">
                                <img src="{{ asset('storage/' . $produk->foto) }}" alt="Gambar {{ $produk->nama }}" class="w-100" />
                            </div>
                            <div class="product-label text-center py-2" style="color: #000000; font-family: 'Bebas Neue', sans-serif; font-size: 1.3rem; letter-spacing: 0.5px;">
                                {{ $produk->nama }}
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <button class="carousel-nav-btn carousel-nav-right" id="btn-scroll-right" aria-label="Gulir ke kanan">
                        <span class="material-icons">chevron_right</span>
                    </button>
                </div>

            </div>
        </section>



    </main>

    <!-- Footer -->
    <footer aria-label="Bagian footer dan akun">
        <div class="container py-5">
            <div class="footer-promo-slider overflow-hidden rounded-3 mb-5" aria-label="Slider banner promosi">
                <div class="footer-promo-track d-flex gap-3" id="footerPromoTrack" aria-live="polite" aria-atomic="true" aria-relevant="additions removals">
                    <div class="footer-promo-slide flex-shrink-0 d-flex justify-content-center align-items-center rounded-3">
                        Promo Launching
                    </div>
                    <div class="footer-promo-slide flex-shrink-0 d-flex justify-content-center align-items-center rounded-3">
                        Belanja Hemat
                    </div>
                    <div class="footer-promo-slide flex-shrink-0 d-flex justify-content-center align-items-center rounded-3">
                        Gratis Ongkir
                    </div>
                    <div class="footer-promo-slide flex-shrink-0 d-flex justify-content-center align-items-center rounded-3">
                        Koleksi Terbaru
                    </div>
                </div>
            </div>
            <div class="row text-start">
                <section class="footer-column col-lg-4 mb-4 mb-lg-0" aria-labelledby="footer-about-title" tabindex="0" style="outline:none;">
                    <h3 id="footer-about-title">Tentang</h3>
                    <p>FashionBrand menyediakan koleksi fashion terbaru yang modern dan berkualitas tinggi dengan harga terbaik.</p>
                    <ul class="list-unstyled">
                        <li><a href="#" tabindex="0" class="text-decoration-none">Profil Kami</a></li>
                        <li><a href="#" tabindex="0" class="text-decoration-none">Karir</a></li>
                        <li><a href="#" tabindex="0" class="text-decoration-none">Blog</a></li>
                    </ul>
                </section>
                <section class="footer-column col-lg-4 mb-4 mb-lg-0" aria-labelledby="footer-help-title" tabindex="0" style="outline:none;">
                    <h3 id="footer-help-title">Bantuan</h3>
                    <ul class="list-unstyled">
                        <li><a href="#" tabindex="0" class="text-decoration-none">Pusat Bantuan</a></li>
                        <li><a href="#" tabindex="0" class="text-decoration-none">Kontak Kami</a></li>
                    </ul>
                </section>
                <section class="footer-column col-lg-4" aria-labelledby="footer-join-title" tabindex="0" style="outline:none;">
                    <h3 id="footer-join-title">Bergabung</h3>
                    <p>Dapatkan informasi terbaru dan penawaran eksklusif langsung ke inbox Anda.</p>
                    <a href="{{ route('login') }}" class="join-cta-button mb-3" aria-label="Tombol untuk masuk atau bergabung melalui login">Gabung Sekarang</a>
                    <div class="footer-social d-flex gap-3" role="region" aria-label="Tombol sosial media">
                        <a href="#" class="social-icon" aria-label="Facebook" tabindex="0"><span class="material-icons" aria-hidden="true">facebook</span></a>
                        <a href="#" class="social-icon" aria-label="Twitter" tabindex="0"><span class="material-icons" aria-hidden="true">twitter</span></a>
                        <a href="#" class="social-icon" aria-label="Instagram" tabindex="0"><span class="material-icons" aria-hidden="true">instagram</span></a>
                        <a href="#" class="social-icon" aria-label="LinkedIn" tabindex="0"><span class="material-icons" aria-hidden="true">linkedin</span></a>
                    </div>
                </section>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Products carousel scroll buttons event
        (() => {
            const carousel = document.getElementById('product-list');
            const btnLeft = document.getElementById('btn-scroll-left');
            const btnRight = document.getElementById('btn-scroll-right');
            const scrollAmount = 240;

            btnLeft.addEventListener('click', () => {
                carousel.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            });

            btnRight.addEventListener('click', () => {
                carousel.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            });
        })();

        // Footer promo slider auto scroll horizontally (back and forth)
        (() => {
            const track = document.getElementById('footerPromoTrack');
            let scrollX = 0;
            const slideWidth = 366; // 360 + 6 gap approx
            const totalSlides = track.children.length;
            const totalWidth = slideWidth * totalSlides;
            let direction = 1; // 1:right, -1:left

            function animate() {
                scrollX += direction * 2;
                if (scrollX > totalWidth - slideWidth * 3 || scrollX <= 0) {
                    direction *= -1;
                }
                track.style.transform = `translateX(${-scrollX}px)`;
                requestAnimationFrame(animate);
            }
            animate();
        })();
    </script>
</body>

</html>