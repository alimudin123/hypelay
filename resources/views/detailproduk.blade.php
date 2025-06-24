@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #ffffff;
        color: #000000;
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

    .text-muted-custom {
        color: #a6a6a6 !important;
    }

    .harga-produk {
        color: #000000;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .kategori-label {
        font-weight: 600;
        color: #a6a6a6;
    }

    .shadow-sm {
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05) !important;
    }
</style>

<div class="container my-5">
    <!-- Tombol Kembali -->
    <div class="mt-4">
        <a href="{{ route('katalog') }}" class="btn btn-kembali mb-3" style="background-color: #000000; color: #ffffff;">← Kembali ke Katalog</a>
    </div>
    <div class="row">
        <div class="col-md-5 mb-4">
            <img src="{{ asset('storage/' . $produk->foto) }}" class="img-fluid rounded shadow-sm" alt="{{ $produk->nama }}">
        </div>
        <div class="col-md-7">
            <h2 class="fw-bold">{{ $produk->nama }}</h2>
            <p class="kategori-label">Kategori: <strong>{{ $produk->kategori->kategori ?? '-' }}</strong></p>
            <div class="harga-produk mb-2">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</div>
            <p><strong>Stok:</strong> {{ $produk->qty }}</p>
            <p><strong>Keterangan:</strong> {{ $produk->kategori->keterangan ?? '-' }}</p>

            {{-- Tombol Tambah ke Keranjang --}}
            <form action="{{ route('keranjang.tambah', $produk->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-custom mt-3">Tambah ke Keranjang</button>
            </form>
        </div>
    </div>
</div>
@endsection