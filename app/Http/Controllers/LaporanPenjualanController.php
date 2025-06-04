<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanPenjualanController extends Controller
{
    /**
     * Menampilkan halaman laporan penjualan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('laporan.penjualan'); // Pastikan file view ini ada di resources/views/laporan/penjualan.blade.php
    }

    /**
     * Mendapatkan data penjualan untuk laporan dalam format JSON.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $query = DB::table('penjualan');

        // Filter berdasarkan tanggal mulai dan tanggal akhir jika disediakan
        if ($request->has('tanggal_mulai') && $request->tanggal_mulai) {
            $query->where('tanggal_penjualan', '>=', $request->tanggal_mulai);
        }
        if ($request->has('tanggal_akhir') && $request->tanggal_akhir) {
            $query->where('tanggal_penjualan', '<=', $request->tanggal_akhir);
        }

        $data = $query->orderBy('tanggal_penjualan', 'desc')->get();

        return response()->json([
            'data' => $data,
        ]);
    }
}
