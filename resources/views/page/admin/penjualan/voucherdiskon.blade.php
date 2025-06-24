@extends('layouts.base_admin.base_dashboard')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Manajemen Voucher Diskon</h2>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">+ Tambah Voucher</button>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Voucher</th>
                <th>Persentase</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vouchers as $index => $voucher)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $voucher->kode }}</td>
                <td>{{ $voucher->persentase }}%</td>
                <td>{{ $voucher->created_at->format('d/m/Y') }}</td>
                <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $voucher->id }}">Edit</button>

                    <form action="{{ route('penjualan.voucherdiskon.destroy', $voucher->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus voucher ini?')">Hapus</button>
                    </form>
                </td>
            </tr>

            <div class="modal fade" id="editModal{{ $voucher->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $voucher->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('penjualan.voucherdiskon.update', $voucher->id) }}" method="POST" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $voucher->id }}">Edit Voucher</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="kodeEdit{{ $voucher->id }}">Kode Voucher</label>
                                <input type="text" name="kode" class="form-control" id="kodeEdit{{ $voucher->id }}" value="{{ $voucher->kode }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="persenEdit{{ $voucher->id }}">Persentase</label>
                                <input type="number" name="persentase" class="form-control" id="persenEdit{{ $voucher->id }}" value="{{ $voucher->persentase }}" min="1" max="100" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

{{-- ✅ Modal Tambah Voucher --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('penjualan.voucherdiskon.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="kode">Kode Voucher</label>
                    <input type="text" name="kode" class="form-control" id="kode" required>
                </div>
                <div class="mb-3">
                    <label for="persentase">Persentase</label>
                    <input type="number" name="persentase" class="form-control" id="persentase" min="1" max="100" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection