@extends('layouts.base_admin.base_dashboard')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Kolom Detail Produk -->
        <div class="col-md-8">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Data Detail Produk</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label font-weight-bold">Nama Produk</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext">{{ $produk->nama }}</p>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label font-weight-bold">Kategori Produk</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext">{{ $produk->get_kategori->kategori }}</p>
                            <small class="text-muted">{{ $produk->get_kategori->keterangan }}</small>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label font-weight-bold">Qty Awal</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext">{{ $produk->qty }}</p>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label font-weight-bold">Harga Jual</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext">Rp. {{ number_format($produk->harga_jual, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label font-weight-bold">Harga Beli</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext">Rp. {{ number_format($produk->harga_beli, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label font-weight-bold">Status Ongkir</label>
                        <div class="col-sm-8">
                            <form action="{{ route('produk.updateStatusOngkir', $produk->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="input-group">
                                    <select name="status_ongkir" class="form-select">
                                        <option value="Pembeli" {{ $produk->status_ongkir == 'Pembeli' ? 'selected' : '' }}>Ditanggung Pembeli</option>
                                        <option value="Penjual" {{ $produk->status_ongkir == 'Penjual' ? 'selected' : '' }}>Ditanggung Penjual</option>
                                    </select>
                                    <button class="btn btn-sm btn-primary" type="submit">Ubah</button>
                                </div>
                            </form>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Diskon (%)</label>
                            <div class="col-sm-8">
                                <form action="{{ route('produk.updateDiskon', $produk->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group">
                                        <input type="number" name="diskon" value="{{ $produk->diskon ?? 0 }}" class="form-control" min="0" max="100">
                                        <button type="submit" class="btn btn-sm btn-primary">Ubah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-end mt-4">
                        <a href="{{ route('produk.index') }}" class="btn btn-warning">Kembali ke Data Produk</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Foto Produk -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light">
                    <h5 class="mb-0 text-center">Foto Produk</h5>
                </div>
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <div class="produk-container position-relative mb-3" onclick="document.getElementById('uploadFoto').click()">
                        @if($produk->foto)
                        <img src="{{ asset('storage/' . $produk->foto) }}" alt="Foto Produk" class="produk-img">
                        @else
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center produk-img">
                            Tidak ada foto
                        </div>
                        @endif

                        <div class="upload-overlay">
                            <div class="text-white text-center">
                                <div class="upload-icon mb-1" style="font-size:24px;">📷</div>
                                <small>Ganti Foto</small>
                            </div>
                        </div>
                    </div>

                    <form id="uploadForm" action="{{ route('produk.updateFoto', $produk->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="uploadFoto" name="foto" accept="image/*" class="d-none" onchange="document.getElementById('uploadForm').submit();">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Style khusus --}}
<style>
    .produk-container {
        width: 300px;
        height: 300px;
        cursor: pointer;
        border-radius: 1px;
        border: 1px solid #ddd;
        overflow: hidden;
    }

    .produk-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
    }

    .upload-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 12px;
    }

    .produk-container:hover .upload-overlay {
        opacity: 1;
    }
</style>
@endsection