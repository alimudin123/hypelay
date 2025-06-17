<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Menjalankan seeder kategori
        $this->call([
            kategoriTableSeeder::class,
        ]);

        // Optional: kalau mau tetap pakai user seeder dari factory
        \App\Models\User::factory(10)->create();
    }
}
