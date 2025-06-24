<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::latest()->get();
        return view('page.admin.penjualan.voucherdiskon', compact('vouchers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:vouchers,kode',
            'persentase' => 'required|integer|min:1|max:100',
        ]);

        Voucher::create($request->only('kode', 'persentase'));

        return redirect()->back()->with('success', 'Voucher berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);

        $request->validate([
            'kode' => 'required|unique:vouchers,kode,' . $voucher->id,
            'persentase' => 'required|integer|min:1|max:100',
        ]);

        $voucher->update($request->only('kode', 'persentase'));

        return redirect()->back()->with('success', 'Voucher berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();

        return redirect()->back()->with('success', 'Voucher berhasil dihapus.');
    }
}
