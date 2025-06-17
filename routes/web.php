<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\produkController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\PenggunaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Di sinilah Anda dapat mendaftarkan rute web untuk aplikasi Anda.
*/

// Untuk customer
Route::get('/', function () {
    return view('welcome');
})->name('beranda');

Auth::routes();

Route::get('/redirect', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('home'); // route admin
        } else {
            return redirect('/pengguna'); // route customer
        }
    }

    return redirect('/login');
});

// Produk (Dashboard Admin)
Route::prefix('dashboard/admin')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/laporan', [LaporanPenjualanController::class, 'index'])->name('laporan.index');

    // Produk CRUD
    Route::prefix('produk')->name('produk.')->group(function () {
        Route::get('/', [ProdukController::class, 'index'])->name('index');            // route('produk.index')
        Route::get('/create', [ProdukController::class, 'create'])->name('create');    // route('produk.create')
        Route::post('/store', [ProdukController::class, 'store'])->name('store');      // route('produk.store')
        Route::get('/edit/{id}', [ProdukController::class, 'edit'])->name('edit');     // route('produk.edit', $id)
        Route::put('/update/{id}', [ProdukController::class, 'update'])->name('update'); // route('produk.update', $id)
        Route::delete('/delete/{id}', [ProdukController::class, 'destroy'])->name('destroy'); // route('produk.destroy', $id)
        Route::get('/show/{id}', [ProdukController::class, 'show'])->name('show');     // route('produk.show', $id)
    });
});

// Profile
Route::prefix('profile')->group(function () {
    Route::get('/', [HomeController::class, 'profile'])->name('profile');
    Route::post('/update', [HomeController::class, 'updateprofile'])->name('profile.update');
});

// Akun
Route::controller(AkunController::class)
    ->prefix('akun')
    ->as('akun.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/showdata', 'dataTable')->name('dataTable');
        Route::match(['get', 'post'], '/tambah', 'tambahAkun')->name('add');
        Route::match(['get', 'post'], '/{id}/ubah', 'ubahAkun')->name('edit');
        Route::delete('/{id}/hapus', 'hapusAkun')->name('delete');
    });

// Katalog
Route::get('/katalog', function () {
    return view('katalog');
})->name('katalog');

Route::get('/keranjang', function () {
    return view('keranjang');
})->name('keranjang');

Route::get('/pengguna', function () {
    return view('pengguna');
})->name('pengguna');

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/akun', [AkunController::class, 'index']);
});

Route::get('/profile/edit', [PenggunaController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [PenggunaController::class, 'update'])->name('profile.update');

Route::post('/profile/upload-image', [App\Http\Controllers\PenggunaController::class, 'uploadImage'])->name('profile.uploadImage');

Route::get('/akun', [App\Http\Controllers\AkunController::class, 'index'])->name('akun.index');
