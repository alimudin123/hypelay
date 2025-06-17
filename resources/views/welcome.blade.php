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
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"></style>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fff;
            color: #111;
        }

        .search-input {
            max-width: 480px;
            border-radius: 2rem !important;
            border: 2px solid #059669 !important;
            padding-left: 3rem !important;
            height: 42px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .search-input:focus {
            border-color: #10b981 !important;
            box-shadow: none !important;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #059669;
            pointer-events: none;
            font-size: 24px;
        }

        /* Hero banner grid */
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

        .btn-cta {
            background: linear-gradient(135deg, #059669, #10b981);
            border: none;
            font-weight: 600;
            font-size: 1.25rem;
            padding: 1rem 3rem;
            border-radius: 2rem;
            box-shadow: 0 8px 20px rgba(5, 150, 105, 0.3);
            transition: background 0.3s ease, box-shadow 0.3s ease;
            user-select: none;
        }

        .btn-cta:hover,
        .btn-cta:focus {
            background: linear-gradient(135deg, #10b981, #059669);
            box-shadow: 0 12px 30px rgba(16, 185, 129, 0.5);
            outline: none;
        }

        /*Gambar Grid pada Beranda*/
        .gambar-beranda {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(2, 200px);
            /* bisa sesuaikan tinggi */
            gap: 1rem;
        }

        .gambar-beranda .item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        /* Gambar besar kiri */
        .item-1 {
            grid-column: 1 / 2;
            grid-row: 1 / 3;
        }

        /* Dua gambar kecil kanan atas */
        .item-2 {
            grid-column: 2 / 3;
            grid-row: 1 / 2;
        }

        .item-3 {
            grid-column: 3 / 5;
            grid-row: 1 / 2;
        }

        /* Gambar besar bawah kanan */
        .item-4 {
            grid-column: 2 / 5;
            grid-row: 2 / 3;
        }

        /* Products horizontal scroll */
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
            background: #fff;
            box-shadow: 0 4px 10px rgb(0 0 0 / 0.05);
            transition: box-shadow 0.3s ease;
            cursor: pointer;
            vertical-align: top;
            user-select: none;
        }

        .product-card:hover,
        .product-card:focus-within {
            box-shadow: 0 10px 20px rgba(5, 150, 105, 0.25);
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
            color: #059669;
            text-align: center;
        }

        /* Carousel nav buttons */
        .carousel-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #059669;
            border: none;
            border-radius: 50%;
            width: 44px;
            height: 44px;
            color: white;
            box-shadow: 0 4px 10px rgba(5, 150, 105, 0.4);
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
            background-color: #0d9488;
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
            padding: 3rem 1rem 3rem 1rem;
        }

        /* Promo slider */
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
            background-color: #059669;
            color: white;
            font-weight: 600;
            font-size: 1.25rem;
            display: flex;
            justify-content: center;
            align-items: center;
            user-select: none;
            cursor: default;
        }

        /* Footer columns */
        .footer-column h3 {
            color: #059669;
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .footer-column p {
            font-size: 1rem;
            color: #374151;
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
            color: #4b5563;
            transition: color 0.3s ease;
        }

        .footer-column ul li a:hover,
        .footer-column ul li a:focus {
            color: #059669;
            outline: none;
        }

        .join-cta-button {
            padding: 0.6rem 2.5rem;
            background-color: #059669;
            border-radius: 2rem;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            transition: background-color 0.3s ease;
            user-select: none;
            cursor: pointer;
        }

        .join-cta-button:hover,
        .join-cta-button:focus {
            background-color: #047857;
            outline: none;
        }

        /* Social icons */
        .footer-social {
            margin-top: 1.5rem;
            display: flex;
            gap: 1rem;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background-color: #059669;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            transition: background-color 0.3s ease;
            text-decoration: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .social-icon:hover,
        .social-icon:focus {
            background-color: #047857;
            outline: none;
        }

        /* Accessibility focus visible */
        :focus-visible {
            outline: 3px solid #22c55e;
            outline-offset: 3px;
        }
    </style>
</head>

<body>
    @include('layouts.header')
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
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/896ea5cc-d46c-4260-a8c0-79727c719dbc.png" alt="Banner Promosi Musim Gugur" />
                    </div>
                    <div class="item item-2">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/b6b3aac2-5ee2-472c-ba26-96c187bafb94.png" alt="Banner Diskon Spesial" />
                    </div>
                    <div class="item item-3">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/7aeb9468-2d78-42b1-8050-ed63fe04e418.png" alt="Banner Koleksi Baru" />
                    </div>
                    <div class="item item-4">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/9336c41a-4512-4c06-a1a1-b8dbfb7f5590.png" alt="Banner Style Modern" />
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-cta" type="button" aria-label="Tombol aksi Belanja">Belanja Sekarang</button>
                </div>
            </div>
        </section>

        <!-- Our Collection -->
        <section id="products" class="py-5" aria-label="Halaman Koleksi Produk" tabindex="-1" style="outline:none;">
            <div class="container">
                <h2 class="mb-4 text-success fw-bold">Our Collection</h2>
                <div class="mb-3">
                    <button type="button" class="btn btn-outline-success active" aria-pressed="true" aria-controls="product-list" id="tab-lorem" tabindex="0">Street Wear</button>
                    <!-- Future tabs could be added here -->
                </div>
                <div class="products-carousel-wrapper position-relative">
                    <button class="carousel-nav-btn carousel-nav-left" aria-label="Scroll produk ke kiri" id="btn-scroll-left" tabindex="0" type="button">
                        <span class="material-icons">chevron_left</span>
                    </button>
                    <div class="products-carousel" id="product-list" role="region" aria-labelledby="tab-lorem" tabindex="0" aria-live="polite" aria-atomic="true">
                        <div class="product-card" tabindex="0">
                            <div class="product-img-wrapper rounded-top overflow-hidden">
                                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/db9ac3e9-dd56-4f5e-8388-3766090e0369.png" alt="Gambar produk 1 dengan desain fashion hijau" class="w-100" />
                            </div>
                            <div class="product-label text-center py-2 fw-semibold text-success">Nama Produk 1</div>
                        </div>
                        <div class="product-card" tabindex="0">
                            <div class="product-img-wrapper rounded-top overflow-hidden">
                                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/8fde3e2f-acae-4c8d-be65-3afa83e65f41.png" alt="Gambar produk 2 dengan desain fashion hijau" class="w-100" />
                            </div>
                            <div class="product-label text-center py-2 fw-semibold text-success">Nama Produk 2</div>
                        </div>
                        <div class="product-card" tabindex="0">
                            <div class="product-img-wrapper rounded-top overflow-hidden">
                                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/02cb556a-b518-4e2d-88fd-eb15ed780e2d.png" alt="Gambar produk 3 dengan desain fashion hijau tua" class="w-100" />
                            </div>
                            <div class="product-label text-center py-2 fw-semibold text-success">Nama Produk 3</div>
                        </div>
                        <div class="product-card" tabindex="0">
                            <div class="product-img-wrapper rounded-top overflow-hidden">
                                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/33c38883-5535-4808-9002-bcef001359dd.png" alt="Gambar produk 4 dengan desain fashion hijau pekat" class="w-100" />
                            </div>
                            <div class="product-label text-center py-2 fw-semibold text-success">Nama Produk 4</div>
                        </div>
                        <div class="product-card" tabindex="0">
                            <div class="product-img-wrapper rounded-top overflow-hidden">
                                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/418dce1c-901c-426d-bccf-ac38e2b0a59a.png" alt="Gambar produk 5 dengan desain fashion hijau klasik" class="w-100" />
                            </div>
                            <div class="product-label text-center py-2 fw-semibold text-success">Nama Produk 5</div>
                        </div>
                    </div>
                    <button class="carousel-nav-btn carousel-nav-right" aria-label="Scroll produk ke kanan" id="btn-scroll-right" tabindex="0" type="button">
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
                        <li><a href="#" tabindex="0" class="text-decoration-none">Pengembalian Barang</a></li>
                        <li><a href="#" tabindex="0" class="text-decoration-none">Kontak Kami</a></li>
                    </ul>
                </section>
                <section class="footer-column col-lg-4" aria-labelledby="footer-join-title" tabindex="0" style="outline:none;">
                    <h3 id="footer-join-title">Bergabung</h3>
                    <p>Dapatkan informasi terbaru dan penawaran eksklusif langsung ke inbox Anda.</p>
                    <button type="button" class="join-cta-button mb-3" aria-label="Tombol untuk bergabung dengan newsletter">Gabung Sekarang</button>
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