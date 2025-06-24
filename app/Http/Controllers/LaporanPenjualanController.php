<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;



class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with(['user', 'items'])->where('status', '!=', 'pending');

        if ($request->from) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->to) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        if ($request->bulan && $request->tahun) {
            $query->whereMonth('created_at', $request->bulan)
                ->whereYear('created_at', $request->tahun);
        }

        $laporan = $query->latest()->get();

        return view('page.admin.laporan.index', compact('laporan'));
    }

    public function exportPdf(Request $request)
    {
        $query = Transaksi::with('user')->where('status', '!=', 'pending');

        if ($request->from) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->to) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $laporan = $query->latest()->get();

        $pdf = Pdf::loadView('exports.laporan_penjualan_pdf', compact('laporan'));
        return $pdf->download('laporan-penjualan.pdf');
    }
}
