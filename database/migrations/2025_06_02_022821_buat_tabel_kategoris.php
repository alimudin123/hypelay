<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kategoris', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Specify InnoDB engine
            $table->increments('id'); // Primary key
            $table->string('kategori'); // Nama kategori
            $table->string('keterangan')->nullable(); // Keterangan kategori, nullable
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategoris');
    }
};

