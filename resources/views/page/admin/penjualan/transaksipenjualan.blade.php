@extends('layouts.base_admin.base_dashboard')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Daftar Transaksi Penjualan</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-success text-center">
            <tr>
                <th>Kode Transaksi & Produk</th>
                <th>Nama Pembeli</th>
                <th>Resi</th>
                <th>Total Pembayaran</th>
                <th>Bukti Pembayaran</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $transaksi)
            <tr>
                <form action="{{ route('admin.transaksi.updateStatus', $transaksi->id) }}" method="POST">
                    @csrf
                    {{-- Kode Transaksi & Produk --}}
                    <td>
                        <strong>{{ $transaksi->kode_transaksi }}</strong><br>
                        <ul class="mb-0 ps-3">
                            @foreach($transaksi->items as $item)
                            <li>{{ $item->nama_produk }} x{{ $item->quantity }}</li>
                            @endforeach
                        </ul>
                    </td>

                    {{-- Nama Pembeli --}}
                    <td>{{ $transaksi->user->name ?? 'User tidak ditemukan' }}</td>

                    {{-- Input Resi --}}
                    <td>
                        <input type="text" name="resi" class="form-control form-control-sm"
                            placeholder="Masukkan Resi" value="{{ old('resi', $transaksi->resi) }}">
                    </td>

                    {{-- Total --}}
                    <td>Rp{{ number_format($transaksi->total, 0, ',', '.') }}</td>

                    {{-- Bukti --}}
                    <td class="text-center">
                        @if($transaksi->bukti)
                        <a href="{{ asset('storage/' . $transaksi->bukti) }}" target="_blank">Lihat Bukti</a>
                        @else
                        Belum ada
                        @endif
                    </td>

                    {{-- Pilih Status --}}
                    <td>
                        <select name="status" class="form-select form-select-sm">
                            <option value="Menunggu Pembayaran" {{ $transaksi->status == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                            <option value="Pembayaran Diterima" {{ $transaksi->status == 'Pembayaran Diterima' ? 'selected' : '' }}>Pembayaran Diterima</option>
                            <option value="Sedang Dikemas" {{ $transaksi->status == 'Sedang Dikemas' ? 'selected' : '' }}>Sedang Dikemas</option>
                            <option value="Dikirim" {{ $transaksi->status == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                            <option value="Selesai" {{ $transaksi->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Dibatalkan" {{ $transaksi->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            <option value="Gagal" {{ $transaksi->status == 'Gagal' ? 'selected' : '' }}>Gagal</option>
                            <option value="Menunggu Konfirmasi Admin" {{ $transaksi->status == 'Menunggu Konfirmasi Admin' ? 'selected' : '' }}>Menunggu Konfirmasi Admin</option>
                        </select>
                    </td>

                    {{-- Tombol Submit --}}
                    <td class="text-center">
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection