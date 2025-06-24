<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiPenjualanController extends Controller
{
    public function index()
    {
        // Load relasi 'items' (produk yang dibeli) dan 'user' (pembeli)
        $transaksis = Transaksi::with(['items', 'user'])->latest()->get();

        return view('page.admin.penjualan.transaksipenjualan', compact('transaksis'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:50',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = $request->status;
        $transaksi->save();

        return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui.');
    }

    public function updateResi(Request $request, $id)
    {
        $request->validate([
            'resi' => 'required|string|max:255',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->resi = $request->resi;
        $transaksi->save();

        return redirect()->back()->with('success', 'Nomor resi berhasil diperbarui.');
    }
}
