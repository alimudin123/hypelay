<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pembayaran - FashionBrand</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    @include('layouts.app')

    <main class="container my-5">
        <h1 class="text-center mb-5" style="color: #000000;">Pembayaran</h1>
        <div class="row g-4">
            <!-- Formulir Pembayaran -->
            <div class="col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-header" style="background-color: #000000; color: #ffffff;">
                        <h5 class="mb-0">Informasi Pembeli</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @php $dataPengguna = Auth::user()->dataPengguna; @endphp

                            <div class="mb-3">
                                <label class="form-label">Alamat Pengiriman</label>
                                <p class="form-control-plaintext">
                                    {{ $dataPengguna->address ?? '-' }}, {{ $dataPengguna->district ?? '-' }},
                                    {{ $dataPengguna->city ?? '-' }}, {{ $dataPengguna->province ?? '-' }},
                                    {{ $dataPengguna->postal_code ?? '-' }}
                                </p>
                            </div>
                            <div class="mb-3">
                                <label for="metode" class="form-label">Metode Pembayaran</label>
                                <select class="form-select" id="metode" name="metode" required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="qris" disabled>QRIS (Belum Tersedia)</option>
                                </select>
                            </div>

                            <button type="button" class="btn w-100 mb-3" style="border: 1px solid #a6a6a6; color: #000000;" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                Lihat Informasi Pembayaran
                            </button>
                            <div class="mb-3">
                                <label for="bukti" class="form-label">Upload Bukti Pembayaran (Transfer)</label>
                                <input type="file" class="form-control" id="bukti" name="bukti" accept="image/*" required>
                            </div>

                            <button type="submit" class="btn w-100 mt-3" style="background-color: #000000; color: #ffffff;">Bayar Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Pembayaran -->
            <div class="col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0" style="color: #000000;">Ringkasan Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        @php
                        $cart = session('cart') ?? [];
                        $subtotal = 0;
                        $ongkirDitanggungPembeli = false;
                        @endphp

                        <ul class="list-group mb-3">
                            @foreach ($cart as $id => $item)
                            @php
                            $produk = App\Models\Produk::find($id);
                            if (!$produk) continue;

                            $diskon = $produk->diskon ?? 0;
                            $hargaAwal = $produk->harga_jual;
                            $hargaSetelahDiskon = $hargaAwal;

                            if ($diskon > 0) {
                            $hargaSetelahDiskon -= ($hargaAwal * $diskon / 100);
                            }

                            $lineTotal = $hargaSetelahDiskon * $item['quantity'];
                            $subtotal += $lineTotal;

                            if ($produk->status_ongkir === 'Pembeli') {
                            $ongkirDitanggungPembeli = true;
                            }
                            @endphp

                            <li class="list-group-item d-flex align-items-center">
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="me-3" style="width: 60px; height: 60px; object-fit: cover; border-radius: 0.5rem;">
                                <div class="flex-grow-1">
                                    <div class="fw-semibold">{{ $item['name'] }}</div>
                                    <div class="text-muted small">Jumlah: {{ $item['quantity'] }}</div>
                                    @if ($diskon > 0)
                                    <div class="small text-danger text-decoration-line-through">Rp{{ number_format($hargaAwal, 0, ',', '.') }}</div>
                                    <div class="small text-success">{{ $diskon }}% OFF</div>
                                    @endif
                                </div>
                                <div class="fw-bold text-dark ms-2">
                                    Rp{{ number_format($lineTotal, 0, ',', '.') }}
                                </div>
                            </li>
                            @endforeach
                        </ul>

                        @php
                        $ongkirLabel = $ongkirDitanggungPembeli ? 'Ditanggung Pembeli' : 'Ditanggung Penjual';
                        $total = $subtotal;
                        $voucherDiskon = session('voucher_diskon') ?? 0;
                        $diskonNominal = ($voucherDiskon / 100) * $subtotal;
                        $total = $subtotal - $diskonNominal;
                        @endphp

                        <form action="{{ route('checkout') }}" method="GET" class="mb-3">
                            <label for="voucher" class="form-label">Kode Voucher</label>
                            <div class="input-group">
                                <input type="text" name="voucher" id="voucher" class="form-control" placeholder="Masukkan kode voucher..." value="{{ request('voucher') }}">
                                <button type="submit" class="btn" style="border: 1px solid #a6a6a6; color: #000000;">Gunakan</button>
                            </div>
                            @if (session('voucher_error'))
                            <div class="form-text text-danger mt-1">{{ session('voucher_error') }}</div>
                            @elseif (session('voucher_diskon'))
                            <div class="form-text text-success mt-1">
                                Voucher berhasil digunakan ({{ session('voucher_diskon') }}%).
                            </div>
                            @endif
                        </form>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Subtotal</span>
                                <strong>Rp{{ number_format($subtotal, 0, ',', '.') }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Ongkos Kirim</span>
                                <strong>{{ $ongkirLabel }}</strong>
                            </li>
                            @if ($voucherDiskon > 0)
                            <li class="list-group-item d-flex justify-content-between text-success">
                                <span>Diskon Voucher ({{ $voucherDiskon }}%)</span>
                                <strong>- Rp{{ number_format($diskonNominal, 0, ',', '.') }}</strong>
                            </li>
                            @endif
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total</span>
                                <strong class="fs-5" style="color: #000000;">Rp{{ number_format($total, 0, ',', '.') }}</strong>
                            </li>
                        </ul>

                        <div class="mt-3 text-muted small">
                            Dengan menekan tombol “Bayar Sekarang”, Anda menyetujui <a href="#">Syarat & Ketentuan</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal QRIS & No Rekening -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header" style="background-color: #000000; color: #ffffff;">
                    <h5 class="modal-title" id="paymentModalLabel">Informasi Pembayaran</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <h6>Transfer Bank</h6>
                    <p class="mb-1"><strong>No. Rekening:</strong></p>
                    <p class="fs-5 fw-semibold">0000 0000 0000 000</p>
                    <p>a.n. PT Fashion Brand Indonesia</p>
                    <hr>
                    <h6 class="mt-3">QRIS</h6>
                    <img src="{{ asset('storage/qris/foto-qris.png') }}" alt="QRIS" class="img-fluid rounded shadow-sm" style="max-width: 300px;">
                    <p class="mt-2 text-muted text-center">QRIS saat ini belum tersedia.</p>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn" style="border: 1px solid #a6a6a6; color: #000000;" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Notifikasi Pembayaran Berhasil -->
    <div class="modal fade" id="successPaymentModal" tabindex="-1" aria-labelledby="successPaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header" style="background-color: #000000; color: #ffffff;">
                    <h5 class="modal-title" id="successPaymentModalLabel">Pembayaran Berhasil</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="mb-3">Terima kasih! Pembayaran Anda telah berhasil diproses.</p>
                    <p class="text-muted small">Silakan cek halaman <a href="{{ route('transaksi') }}">Transaksi</a> untuk melihat status pesanan Anda.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn" style="background-color: #000000; color: #ffffff;" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successModal = new bootstrap.Modal(document.getElementById('successPaymentModal'));
            successModal.show();
        });
    </script>
    @endif

</body>

</html>