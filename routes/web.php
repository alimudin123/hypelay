<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    HomeController,
    AkunController,
    ProdukController,
    LaporanPenjualanController,
    PenggunaController,
    VoucherController,
    KeranjangController,
    CheckoutController,
    TransaksiController,
    TransaksiPenjualanController,
    BerandaController,
};

// ==========================
// Landing Page / Beranda
// ==========================
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// ==========================
// Auth Routes
// ==========================
Auth::routes();

Route::get('/redirect', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return $user->role === 'admin' ? redirect()->route('home') : redirect('/pengguna');
    }
    return redirect('/login');
});

// ==========================
// Admin Routes
// ==========================
Route::prefix('dashboard/admin')->middleware(['auth', 'admin.only'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Produk CRUD
    Route::prefix('produk')->name('produk.')->group(function () {
        Route::get('/', [ProdukController::class, 'index'])->name('index');
        Route::get('/create', [ProdukController::class, 'create'])->name('create');
        Route::post('/store', [ProdukController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProdukController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProdukController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ProdukController::class, 'destroy'])->name('destroy');
        Route::get('/show/{id}', [ProdukController::class, 'show'])->name('show');
    });

    Route::get('/laporan-penjualan', [LaporanPenjualanController::class, 'index'])->name('laporan.penjualan');
});
    Route::get('/laporan-penjualan/cetak', [LaporanPenjualanController::class, 'exportPdf'])->name('laporan.penjualan.cetak');

// ==========================
// Produk dan Katalog
// ==========================
Route::get('/katalog', [ProdukController::class, 'katalog'])->name('katalog');
Route::get('/produk/{id}', [ProdukController::class, 'detail'])->name('produk.detail');
Route::put('/produk/{id}/status-ongkir', [ProdukController::class, 'updateStatusOngkir'])->name('produk.updateStatusOngkir');
Route::put('/produk/{id}/diskon', [ProdukController::class, 'updateDiskon'])->name('produk.updateDiskon');
Route::post('/produk/{id}/update-foto', [ProdukController::class, 'updateFoto'])->name('produk.updateFoto');

// ==========================
// Keranjang dan Checkout
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang');
    Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
});

// ==========================
// Transaksi dan Penjualan
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
    Route::post('/transaksi/{id}/upload-bukti', [TransaksiController::class, 'uploadBukti'])->name('transaksi.uploadBukti');
    Route::get('/detailtransaksi/{id}', [TransaksiController::class, 'show'])->name('detailtransaksi');

    Route::prefix('penjualan')->group(function () {
        Route::get('/transaksipenjualan', [TransaksiPenjualanController::class, 'index'])->name('penjualan.transaksipenjualan');
        Route::post('/admin/transaksi/update-status/{id}', [TransaksiPenjualanController::class, 'updateStatus'])->name('admin.transaksi.updateStatus');
        Route::post('/admin/transaksi/{id}/update-resi', [TransaksiPenjualanController::class, 'updateResi'])->name('admin.transaksi.updateResi');

        // Voucher Diskon
        Route::get('/diskon', [VoucherController::class, 'index'])->name('penjualan.voucherdiskon.index');
        Route::post('/diskon', [VoucherController::class, 'store'])->name('penjualan.voucherdiskon.store');
        Route::put('/diskon/{voucher}', [VoucherController::class, 'update'])->name('penjualan.voucherdiskon.update');
        Route::delete('/diskon/{voucher}', [VoucherController::class, 'destroy'])->name('penjualan.voucherdiskon.destroy');
    });
});

// ==========================
// Akun dan Profil
// ==========================
Route::get('/profile/edit', [PenggunaController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [PenggunaController::class, 'update'])->name('profile.update');
Route::post('/profile/upload-image', [PenggunaController::class, 'uploadImage'])->name('profile.uploadImage');

Route::get('/akun', [AkunController::class, 'index'])->name('akun.index');
Route::get('/akun/{id}/detail', [AkunController::class, 'detailAkun'])->name('akun.detail');

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/akun', [AkunController::class, 'index']);
});

Route::controller(AkunController::class)->prefix('akun')->as('akun.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/showdata', 'dataTable')->name('dataTable');
    Route::match(['get', 'post'], '/tambah', 'tambahAkun')->name('add');
    Route::match(['get', 'post'], '/{id}/ubah', 'ubahAkun')->name('edit');
    Route::delete('/{id}/hapus', 'hapusAkun')->name('delete');
});

// ==========================
// Pengguna (Customer Dashboard)
// ==========================
Route::get('/pengguna', function () {
    return view('pengguna');
})->name('pengguna');

Route::middleware(['auth', 'role'])->group(function () {});

Route::middleware(['auth'])->prefix('dashboard/admin')->group(function () {
    // Dashboard utama admin
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Profile admin
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [HomeController::class, 'updateprofile'])->name('profile.update');
});
