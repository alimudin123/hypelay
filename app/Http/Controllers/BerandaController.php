<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class BerandaController extends Controller
{
    /**
     * Tampilkan halaman beranda.
     */
    public function index()
    {
        // Ambil 7 produk terbaru
        $produks = Produk::latest()->take(7)->get();

        // Kirim ke view
        return view('beranda', compact('produks'));
    }
}
