<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class KeranjangController extends Controller
{
    public function index()
    {
        $produks = Produk::all(); // atau query yang sesuai
        return view('keranjang', compact('produks'));
    }

    // Contoh method di CartController
    public function tambah($id)
    {
        $produk = \App\Models\Produk::findOrFail($id); // ✅ pastikan model-nya benar

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $produk->nama,
                'price' => $produk->harga_jual, 
                'quantity' => 1,
                'image' => $produk->foto,       
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
