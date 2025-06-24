<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Langsung ambil semua transaksi user beserta items-nya
        $transaksis = Transaksi::with('items')->where('user_id', $user->id)->latest()->get();

        return view('transaksi', compact('transaksis'));
    }


    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $transaksi = Transaksi::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti_transaksi', 'public');
            $transaksi->bukti = $path;
            $transaksi->save();
        }

        return redirect()->route('transaksi')->with('success', 'Bukti pembayaran berhasil diupload.');
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('items')->findOrFail($id);

        // Pastikan hanya pemilik yang bisa melihat transaksinya
        if ($transaksi->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }
        return view('detailtransaksi', compact('transaksi'));
    }
}
