<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Voucher;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // Ambil daftar item yang dipilih oleh user
        $selected = explode(',', $request->selected_items);

        // Cek dan proses kode voucher
        if ($request->has('voucher') && $request->voucher !== null) {
            $voucher = Voucher::where('kode', $request->voucher)->first();

            if ($voucher) {
                session(['voucher_diskon' => $voucher->persentase]);
                session()->forget('voucher_error');
            } else {
                session()->forget('voucher_diskon');
                session(['voucher_error' => 'Kode voucher tidak valid.']);
            }

            return redirect()->route('checkout');
        }

        $cart = session('cart') ?? [];
        $subtotal = 0;
        $ongkirDitanggungPembeli = false;

        // Gunakan hanya item yang dipilih
        foreach ($cart as $id => $item) {
            if (!in_array($id, $selected)) continue; // Hanya proses yang dicentang

            $produk = Produk::find($id);
            if (!$produk) continue;

            $harga = $produk->harga_jual;
            $diskon = $produk->diskon ?? 0;
            $harga -= ($harga * $diskon / 100);
            $subtotal += $harga * $item['quantity'];

            if ($produk->status_ongkir === 'Pembeli') {
                $ongkirDitanggungPembeli = true;
            }
        }

        $voucherDiskonPersen = session('voucher_diskon', 0);
        $voucherDiskon = $subtotal * ($voucherDiskonPersen / 100);
        $total = $subtotal - $voucherDiskon;

        return view('checkout', compact(
            'cart',
            'subtotal',
            'voucherDiskonPersen',
            'voucherDiskon',
            'total',
            'ongkirDitanggungPembeli'
        ));
    }

    public function process(Request $request)
    {
        $request->validate([
            'metode' => 'required',
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $cart = session('cart', []);
        $voucherDiskonPersen = session('voucher_diskon', 0);

        if (empty($cart)) {
            return back()->with('error', 'Keranjang kosong.');
        }

        // Upload bukti pembayaran jika ada
        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_pembayaran', 'public');
        }

        // Hitung total
        $subtotal = 0;
        foreach ($cart as $id => $item) {
            $produk = \App\Models\Produk::find($id);
            if (!$produk) continue;

            $hargaAwal = $produk->harga_jual;
            $diskonProduk = $produk->diskon ?? 0;

            $hargaSetelahDiskon = $hargaAwal - ($hargaAwal * $diskonProduk / 100);
            $subtotal += $hargaSetelahDiskon * $item['quantity'];
        }

        $totalDiskon = ($voucherDiskonPersen / 100) * $subtotal;
        $totalBayar = $subtotal - $totalDiskon;

        // Buat kode transaksi unik
        $kodeTransaksi = 'TRX-' . strtoupper(Str::random(8));

        // Buat transaksi utama
        $transaksi = Transaksi::create([
            'user_id' => $user->id,
            'kode_transaksi' => $kodeTransaksi,
            'metode_pembayaran' => $request->metode,
            'bukti' => $buktiPath,
            'total' => $totalBayar, 
            'status' => 'Menunggu Konfirmasi',
        ]);

        // Simpan item satu per satu
        foreach ($cart as $id => $item) {
            $produk = \App\Models\Produk::find($id);
            if (!$produk) continue;

            $hargaAwal = $produk->harga_jual;
            $diskonProduk = $produk->diskon ?? 0;
            $hargaSetelahDiskon = $hargaAwal - ($hargaAwal * $diskonProduk / 100);

            if ($voucherDiskonPersen > 0) {
                $hargaSetelahDiskon -= ($hargaSetelahDiskon * $voucherDiskonPersen / 100);
            }

            TransaksiItem::create([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $produk->id,
                'nama_produk' => $produk->nama,
                'quantity' => $item['quantity'],
                'harga' => $hargaSetelahDiskon,
            ]);
        }

        // Bersihkan session cart & voucher
        session()->forget('cart');
        session()->forget('voucher_diskon');

        return redirect()->route('transaksi')->with('success', 'Transaksi berhasil dibuat!');
    }
}
