<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kode_transaksi',
        'metode_pembayaran',
        'bukti',
        'total',
        'status',
        'resi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(TransaksiItem::class);
    }
}
