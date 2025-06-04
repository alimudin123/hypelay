<?php

namespace Database\Seeders;

use App\Models\kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class kategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //menambahkan data pada tabel kategori
        kategori::create(['kategori' => 'Kaos Polos', 'keterangan' => 'Kaos Polos Kain Katun 180 gsm']);
        kategori::create(['kategori' => 'Kaos Sablon', 'keterangan' => 'Kaos Sablon Kain Katun 180 gsm']);
    }
}
