<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenjualanController extends Controller
{
     // Menampilkan halaman transaksi
    public function transaksi()
    {
        return view('page.admin.penjualan.transaksi'); // Buat view di resources/views/penjualan/transaksi.blade.php
    }

    // Menampilkan halaman diskon
    public function diskon()
    {
        return view('page.admin.penjualan.diskon'); // Buat view di resources/views/penjualan/diskon.blade.php
    }

    // Menampilkan halaman ongkir
    public function ongkir()
    {
        return view('page.admin.penjualan.ongkir'); // Buat view di resources/views/penjualan/ongkir.blade.php
    }
}
