<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_pengguna', function (Blueprint $table) {
            $table->id();

            // Foreign key ke tabel users
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Kolom tambahan profil
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_pengguna');
    }
};
