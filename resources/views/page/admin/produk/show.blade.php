@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-head container-fluid" style="margin-top: 10px;">
                    <p>Data Detail produk</p>
                </div>
                <div class="form-horizontal">
                    <div class="panel-body">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="row mb-3">
                            <label class="col-sm-2">Nama Produk</label>
                            <div
                                class="col-sm-10">
                                <p>{{ $produk->nama }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2">Kategori Produk</label>
                            <div class="col-sm-10">
                                <div>{{ $produk->get_kategori->kategori }}</div>
                                <div>{{ $produk->get_kategori->keterangan }}</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2">Qty Awal</label>
                            <div class="col-sm-10">
                                <p>{{ $produk->qty }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2">Harga
                                Jual</label>
                            <div class="col-sm-10">
                                <p>Rp. {{ $produk->harga_jual }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2">Harga
                                Beli</label>
                            <div class="col-sm-10">
                                <p>Rp. {{ $produk->harga_beli }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-offset-2 col-sm10">
                                <a href="{{  route('produk.index')  }}" class="btn btn-warning">Data Produk</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection