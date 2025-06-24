<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function get_produk()
    {
        return $this->hasMany(produk::class, 'id_kategori');
    }

    // Relasi: satu kategori memiliki banyak produk
    public function produks()
    {
        return $this->hasMany(Produk::class, 'id_kategori');
    }
}
