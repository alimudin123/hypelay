<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi: tambahkan kolom total jika belum ada.
     */
    public function up()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            if (!Schema::hasColumn('transaksis', 'total')) {
                $table->decimal('total', 15, 2)->after('bukti');
            }
        });
    }

    /**
     * Balik migrasi: hapus kolom total.
     */
    public function down()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            if (Schema::hasColumn('transaksis', 'total')) {
                $table->dropColumn('total');
            }
        });
    }
};
