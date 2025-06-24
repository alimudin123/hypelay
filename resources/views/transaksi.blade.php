@extends('layouts.app')

@section('content')
<div class="container my-5">
    <!-- Tombol Kembali -->
    <div class="mt-4">
        <a href="{{ route('pengguna') }}" class="btn btn-kembali mb-3" style="background-color: #000000; color: #ffffff;">← Kembali ke Akun</a>
    </div>
    <h2 class="mb-4" style="color: #000;">Daftar Transaksi Anda</h2>

    @if ($transaksis->isEmpty())
    <div class="alert alert-info">Belum ada transaksi.</div>
    @else
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="bg-dark text-white text-center">
                <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Resi</th>
                    <th>Total</th>
                    <th>Bukti</th>
                    <th>Status Pesanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksis as $transaksi)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $transaksi->kode_transaksi }}</td>
                    <td class="text-center">{{ $transaksi->resi ?? '-' }}</td>
                    <td class="text-end">Rp{{ number_format($transaksi->total, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @if ($transaksi->bukti)
                        <a href="{{ asset('storage/' . $transaksi->bukti) }}" target="_blank" class="btn btn-sm btn-dark">Lihat</a>
                        @else
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal{{ $transaksi->id }}">
                            Upload Bukti
                        </button>
                        @endif
                    </td>
                    <td class="text-center">{{ $transaksi->status ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('detailtransaksi', $transaksi->id) }}" class="btn btn-sm btn-dark">Lihat Detail</a>
                    </td>
                </tr>

                <!-- Modal Upload Bukti -->
                <div class="modal fade" id="uploadModal{{ $transaksi->id }}" tabindex="-1" aria-labelledby="uploadModalLabel{{ $transaksi->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('transaksi.uploadBukti', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="uploadModalLabel{{ $transaksi->id }}">Upload Bukti Pembayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="bukti" class="form-label">Pilih Gambar Bukti</label>
                                        <input type="file" name="bukti" class="form-control" required accept="image/*">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-dark">Kirim</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection