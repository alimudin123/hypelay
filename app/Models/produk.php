<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function get_kategori()
    {
        // relasi dengan tabel produk
        return $this->hasOne('App\Models\kategori', 'id', 'id_kategori');
    }
}
