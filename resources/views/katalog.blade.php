<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Katalog Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #ffffff;
      color: #000000;
      padding: 2rem 1rem;
    }

    .catalog-title {
      font-weight: 700;
      font-size: 2.5rem;
      margin-bottom: 2rem;
      text-align: center;
      color: #000000;
    }

    .catalog-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
    }

    .catalog-item {
      background: #ffffff;
      border-radius: 0.75rem;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
      overflow: hidden;
      transition: 0.3s;
      border: 1px solid #e5e5e5;
    }

    .catalog-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .catalog-img-wrapper img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .catalog-info {
      padding: 1rem;
      text-align: center;
    }

    .catalog-name {
      font-weight: 600;
      font-size: 1.2rem;
      margin-bottom: 0.5rem;
      color: #000000;
    }

    .catalog-price {
      color: #a6a6a6;
      font-weight: 500;
    }
  </style>

</head>

<body>
  @include('layouts.app')

  @if(session('success'))
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
    <div id="toastSuccess" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          {{ session('success') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>
  @endif

  <h2 class="catalog-title">Katalog Produk</h2>

  <div class="container">
    <div class="catalog-grid">
      @foreach($produks as $produk)
      <article class="catalog-item">
        <div class="catalog-img-wrapper">
          <a href="{{ route('produk.detail', $produk->id) }}">
            <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama }}">
          </a>
        </div>
        <div class="catalog-info">
          <h3 class="catalog-name">{{ $produk->nama }}</h3>
          <p class="text-center">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</p>

          {{-- Tambah ke Keranjang --}}
          <form action="{{ route('keranjang.tambah', $produk->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn" style="background-color: #000000; color: #ffffff; border: none;">
              Tambah ke Keranjang
            </button>
          </form>
        </div>
      </article>
      @endforeach
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const toastEl = document.getElementById('toastSuccess');
      if (toastEl) {
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
      }
    });
  </script>
</body>

</html>