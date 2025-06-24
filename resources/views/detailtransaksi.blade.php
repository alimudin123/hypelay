@extends('layouts.app')

@section('content')

<div class="container my-5">
    <!-- Tombol Kembali -->
    <div class="mt-4">
        <a href="{{ route('transaksi') }}" class="btn btn-kembali mb-3" style="background-color: #000000; color: #ffffff;">← Kembali ke Daftar Transaksi</a>
    </div>

    <!-- Daftar Produk -->
    <div class="mb-4">
        <h5 class="mb-3" style="color: #000;">Produk yang Dibeli</h5>
        <div class="row g-3">
            @foreach ($transaksi->items as $item)
            @php
            $produk = \App\Models\Produk::find($item->produk_id);
            $image = $produk?->foto ?? 'default.jpg';
            $hargaAwal = $produk?->harga_jual ?? $item->harga;
            $hargaDiskon = $hargaAwal - $item->harga;
            @endphp
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm" style="border: 1px solid #e0e0e0;">
                    <img src="{{ asset('storage/' . $image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $item->nama_produk }}">
                    <div class="card-body">
                        <h6 class="card-title" style="color: #000;">{{ $item->nama_produk }}</h6>
                        <p class="mb-1 text-muted">Jumlah: <strong>{{ $item->quantity }}</strong></p>
                        <p class="mb-1 text-harga" style="color: #000;">
                            Harga Satuan:
                            @if ($hargaDiskon > 0)
                            <span class="text-decoration-line-through" style="color: #a6a6a6;">Rp{{ number_format($hargaAwal, 0, ',', '.') }}</span>
                            <span class="text-success ms-1" style="color: #000;">Rp{{ number_format($item->harga, 0, ',', '.') }}</span>
                            @else
                            <strong>Rp{{ number_format($hargaAwal, 0, ',', '.') }}</strong>
                            @endif
                        </p>

                        @if($hargaDiskon > 0)
                        <p class="mb-1" style="color: #000;">
                            Diskon: -Rp{{ number_format($hargaDiskon, 0, ',', '.') }}
                        </p>
                        @endif

                        <p class="mb-0 text-total" style="color: #000; font-weight: 600;">
                            Total: Rp{{ number_format($item->harga * $item->quantity, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection