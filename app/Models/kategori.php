<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris'; // atau hapus ini kalau kamu pakai nama tabel 'kategori'
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function get_produk()
    {
        return $this->hasMany(produk::class, 'id_kategori');
    }
}
