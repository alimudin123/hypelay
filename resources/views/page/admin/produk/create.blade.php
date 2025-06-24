@extends('layouts.base_admin.base_dashboard')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-head container-fluid" style="margin-top: 10px;">
                    <p>Tambah Data Produk</p> 
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('produk.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-sm-2">Nama Produk</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama') }}">
                                @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Kategori Produk</label>
                            <div class="col-sm-10">
                                <select name="kategori" class="form-control @error('kategori') is-invalid @enderror" id="kategori">
                                    <option value="">Pilih Kategori</option> <!-- Perbaikan: Pindahkan opsi default ke atas -->
                                    @if ($errors->has('kategori'))
                                    <span class="text-danger">{{ $errors->first('kategori') }}</span> 
                                    @endif
                                    @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}" {{ old('kategori') == $k->id ? 'selected' : '' }}> {{ $k->kategori }} </option> 
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Qty Awal</label>
                            <div class="col-sm-10">
                                <input type="text" name="qty" class="form-control @error('qty') is-invalid @enderror" id="qty" value="{{ old('qty') }}">
                                @if ($errors->has('qty'))
                                <span class="text-danger">{{ $errors->first('qty') }}</span> 
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Harga Beli</label>
                            <div class="col-sm-10">
                                <input type="text" name="harga_beli" class="form-control @error('harga_beli') is-invalid @enderror" id="harga_beli" value="{{ old('harga_beli') }}">
                                @if ($errors->has('harga_beli'))
                                <span class="text-danger">{{ $errors->first('harga_beli') }}</span> 
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Harga Jual</label>
                            <div class="col-sm-10">
                                <input type="text" name="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" id="harga_jual" value="{{ old('harga_jual') }}">
                                @if ($errors->has('harga_jual'))
                                <span class="text-danger">{{ $errors->first('harga_jual') }}</span> 
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('produk.index') }}" class="btn btn-warning">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection