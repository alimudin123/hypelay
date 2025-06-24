<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPengguna extends Model
{
    use HasFactory;

    protected $table = 'data_pengguna';

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'district',
        'city',
        'province',
        'postal_code'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
