<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\DataPengguna;
use App\Models\User;

class PenggunaController extends Controller
{
    public function edit()
    {
        return view('edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email',
            'phone'       => 'nullable|digits_between:10,15',
            'address'     => 'nullable|string|max:255',
            'district'    => 'nullable|string|max:100',
            'city'        => 'nullable|string|max:100',
            'province'    => 'nullable|string|max:100',
            'postalCode'  => 'nullable|digits_between:5,10',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $user->dataPengguna()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone'       => $validated['phone'] ?? null,
                'address'     => $validated['address'] ?? null,
                'district'    => $validated['district'] ?? null,
                'city'        => $validated['city'] ?? null,
                'province'    => $validated['province'] ?? null,
                'postal_code' => $validated['postalCode'] ?? null,
            ]
        );

        return redirect()->route('pengguna')->with('success', 'Profil berhasil diperbarui.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'user_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        // Hapus gambar lama jika ada
        if ($user->user_image && Storage::disk('public')->exists('profile/' . $user->user_image)) {
            Storage::disk('public')->delete('profile/' . $user->user_image);
        }

        // Simpan gambar baru
        $file = $request->file('user_image');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('profile', $filename, 'public');

        // Simpan hanya nama file
        $user->user_image = $filename;
        $user->save();

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}
