@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <h1>Data Produk</h1>
                <div class="panel-head container-fluid" style="margin-top:10px;">
                    <a class="btn btn-success" href="{{ route('produk.create') }}">Tambah Produk</a>
                </div>
                <div class="panel-body">
                    <table id="products-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Qty</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Dibuat Pada</th>
                                <th>Diedit Pada</th>
                                <th colspan="3" style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $i => $p)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->get_kategori ? $p->get_kategori->kategori : '' }}</td>
                                <td>{{ $p->qty }}</td>
                                <td>{{ $p->harga_beli }}</td>
                                <td>{{ $p->harga_jual }}</td>
                                <td>{{ $p->created_at }}</td>
                                <td>{{ $p->updated_at }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('produk.show', $p->id) }}">Detail</a>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('produk.edit', $p->id) }}">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('produk.destroy', $p->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin Data Dihapus?')" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection