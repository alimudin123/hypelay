@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Profil</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ old('name', Auth::user()->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" class="form-control" id="email" name="email"
                value="{{ old('email', Auth::user()->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="tel" class="form-control" id="phone" name="phone"
                value="{{ old('phone', Auth::user()->dataPengguna->phone ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="address" name="address"
                value="{{ old('address', Auth::user()->dataPengguna->address ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Kota</label>
            <input type="text" class="form-control" id="city" name="city"
                value="{{ old('city', Auth::user()->dataPengguna->city ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="postalCode" class="form-label">Kode Pos</label>
            <input type="text" class="form-control" id="postalCode" name="postalCode"
                value="{{ old('postalCode', Auth::user()->dataPengguna->postal_code ?? '') }}">
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
@endsection
