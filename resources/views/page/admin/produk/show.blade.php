@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <!-- Kolom Data Produk -->
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-head container-fluid" style="margin-top: 10px;">
                    <p>Data Detail Produk</p>
                </div>
                <div class="form-horizontal">
                    <div class="panel-body">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="row mb-3">
                            <label class="col-sm-4">Nama Produk</label>
                            <div class="col-sm-8">
                                <p>{{ $produk->nama }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4">Kategori Produk</label>
                            <div class="col-sm-8">
                                <p>{{ $produk->get_kategori->kategori }}</p>
                                <small>{{ $produk->get_kategori->keterangan }}</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4">Qty Awal</label>
                            <div class="col-sm-8">
                                <p>{{ $produk->qty }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4">Harga Jual</label>
                            <div class="col-sm-8">
                                <p>Rp. {{ number_format($produk->harga_jual, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4">Harga Beli</label>
                            <div class="col-sm-8">
                                <p>Rp. {{ number_format($produk->harga_beli, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <!-- Kolom Foto Produk -->
                        <div class="col-md-4 text-center">
                            <div class="mb-3">
                                <p><strong>Foto Produk</strong></p>
                                @if ($produk->foto)
                                <img src="{{ asset('storage/' . $produk->foto) }}" alt="Foto Produk" class="img-fluid rounded" style="max-height: 300px;">
                                @else
                                <div class="bg-secondary text-white p-5 rounded">Tidak ada foto</div>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-12 text-end">
                                <a href="{{ route('produk.index') }}" class="btn btn-warning">Kembali ke Data Produk</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection