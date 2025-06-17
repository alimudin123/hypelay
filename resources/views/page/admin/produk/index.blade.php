@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Produk</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
        </nav>
    </div>
    
    <a href="{{ route('produk.create') }}" class="btn btn-success">
        + Tambah Produk
    </a>
</div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Qty</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Dibuat</th>
                    <th>Update</th>
                    <th colspan="3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produk as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->get_kategori?->kategori ?? '-' }}</td>
                    <td>{{ $p->qty }}</td>
                    <td>Rp {{ number_format($p->harga_beli, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($p->harga_jual, 0, ',', '.') }}</td>
                    <td>{{ $p->created_at->format('d/m/Y') }}</td>
                    <td>{{ $p->updated_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('produk.show', $p->id) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                    </td>
                    <td>
                        <a href="{{ route('produk.edit', $p->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('produk.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
