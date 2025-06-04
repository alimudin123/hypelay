<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Specify InnoDB engine
            $table->id(); // Primary key
            $table->unsignedInteger('id_kategori'); // Use unsignedInteger for foreign key
            $table->integer('qty'); // Jumlah produk
            $table->integer('harga_beli'); // Harga beli produk
            $table->integer('harga_jual'); // Harga jual produk
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_kategori')->references('id')->on('kategoris')
                ->onDelete('restrict')->onUpdate('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('produks');
    }
};
