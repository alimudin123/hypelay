<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     * Tidak dipakai karena kita override method `authenticated`.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Menentukan kolom yang digunakan untuk login.
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Menampilkan halaman login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Redirect pengguna berdasarkan role setelah login berhasil.
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'pegawai') {
            return redirect()->route('home'); // Mengarah ke dashboard pegawai
        }

        if ($user->role === 'customer') {
            return redirect()->route('pengguna'); // Mengarah ke halaman utama
        }

        // Default jika role tidak dikenali
        auth()->logout(); // logout user
        return redirect()->route('login')->withErrors(['email' => 'Role tidak dikenali.']);
    }
}
