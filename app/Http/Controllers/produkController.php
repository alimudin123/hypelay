<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all();
        return view('page.admin.produk.index', ['produk' => $produk]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('page.admin.produk.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'qty' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
        ]);

        Produk::create([
            'nama' => $request->nama,
            'id_kategori' => $request->kategori,
            'qty' => $request->qty,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'status_ongkir' => 'Pembeli', // otomatis default
        ]);

        return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::orderBy('kategori', 'asc')->get();
        return view('page.admin.produk.show', compact('produk', 'kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::orderBy('kategori', 'asc')->get();
        return view('page.admin.produk.edit', compact('produk', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'qty' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
        ]);

        Produk::where('id', $id)->update([
            'nama' => $request->nama,
            'id_kategori' => $request->kategori,
            'qty' => $request->qty,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ]);

        return redirect()->route('produk.index')->with('success', 'Data Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->delete()) {
            return redirect()->route('produk.index')->with('success', 'Data Berhasil Dihapus!');
        }

        return redirect()->route('produk.index')->with('error', 'Gagal Menghapus Data!');
    }

    public function updateFoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $produk = Produk::findOrFail($id);

        // Hapus foto lama (jika ada)
        if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }

        $path = $request->file('foto')->store('produk', 'public');
        $produk->foto = $path;
        $produk->save();

        return back()->with('status', 'Foto produk berhasil diperbarui!');
    }

    public function katalog()
    {
        $produks = Produk::all();
        return view('katalog', compact('produks'));
    }

    public function updateStatusOngkir(Request $request, $id)
    {
        $request->validate([
            'status_ongkir' => 'required|in:Pembeli,Penjual',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->status_ongkir = $request->status_ongkir;
        $produk->save();

        return redirect()->back()->with('success', 'Status ongkir berhasil diubah!');
    }

    public function updateDiskon(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->diskon = $request->diskon ?? 0;
        $produk->save();

        return redirect()->back()->with('success', 'Diskon berhasil diperbarui.');
    }
    public function detail($id)
    {
        $produk = Produk::with('kategori')->findOrFail($id);
        return view('detailproduk', compact('produk'));
    }
}
