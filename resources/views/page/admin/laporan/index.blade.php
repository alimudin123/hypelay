@extends('layouts.base_admin.base_dashboard')

@section('content')
<div class="container my-5">
  <h2 class="mb-4 text-success">📊 Laporan Penjualan</h2>

  <!-- Filter -->
  <form method="GET" class="row g-3 align-items-end mb-4">
    <div class="col-md-4">
      <label for="from" class="form-label">Dari Tanggal</label>
      <input type="date" name="from" id="from" class="form-control" value="{{ request('from') }}">
    </div>
    <div class="col-md-4">
      <label for="to" class="form-label">Sampai Tanggal</label>
      <input type="date" name="to" id="to" class="form-control" value="{{ request('to') }}">
    </div>
    <div class="col-md-4">
      <button type="submit" class="btn btn-success w-100">
        <i class="bi bi-filter"></i> Filter
      </button>
    </div>
  </form>
  
  <div class="col-md-4">
    <a href="{{ route('laporan.penjualan.cetak', ['from' => request('from'), 'to' => request('to')]) }}"
      target="_blank"
      class="btn btn-outline-danger w-100">
      <i class="bi bi-file-earmark-pdf"></i> Cetak PDF
    </a>
  </div>

  <!-- Tabel Laporan -->
  <div class="table-responsive">
    <table class="table table-bordered align-middle text-center shadow-sm">
      <thead class="table-success">
        <tr>
          <th>No</th>
          <th>Kode Transaksi</th>
          <th>Pembeli</th>
          <th>Resi</th> {{-- Kolom Resi --}}
          <th>Total</th>
          <th>Status</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($laporan as $index => $trx)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td class="fw-semibold text-primary">{{ $trx->kode_transaksi }}</td>
          <td>{{ $trx->user->name ?? '-' }}</td>
          <td>{{ $trx->resi ?? '-' }}</td> {{-- Isi Resi --}}
          <td class="text-end">Rp{{ number_format($trx->total, 0, ',', '.') }}</td>
          <td>
            <span class="badge 
                            @if($trx->status === 'selesai') bg-success
                            @elseif($trx->status === 'diproses') bg-warning text-dark
                            @elseif($trx->status === 'dibatalkan') bg-danger
                            @else bg-secondary
                            @endif">
              {{ ucfirst($trx->status) }}
            </span>
          </td>
          <td>{{ $trx->created_at->translatedFormat('d M Y') }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-muted">Tidak ada data transaksi pada rentang waktu ini.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection