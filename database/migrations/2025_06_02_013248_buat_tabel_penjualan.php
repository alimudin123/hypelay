<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BuatTabelPenjualan extends Migration
{
    /**
     * Menjalankan migrasi - membuat tabel penjualan.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id');
            $table->integer('jumlah');
            $table->decimal('total_harga', 15, 2);
            $table->date('tanggal_penjualan');
            $table->timestamps();

            // Jika tabel produk ada, bisa aktifkan foreign key ini
            // $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');
        });
    }

    /**
     * Membalikkan migrasi - menghapus tabel penjualan.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan');
    }
}
