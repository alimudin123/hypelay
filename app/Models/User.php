<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\dataPengguna;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_image',
        'role',
        'phone',
        'address',
        'city',
        'postalCode' // <- Ini hanya berguna kalau kolomnya memang ada di tabel users (saat ini tidak)
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ⬇⬇ Tambahkan relasi ke tabel data_pengguna di sini
    public function dataPengguna()
    {
        return $this->hasOne(dataPengguna::class, 'user_id');
    }
}
