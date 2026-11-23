<?php

namespace App\Http\Controllers;

use App\Models\AkunPelanggan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthPelangganController extends Controller
{
    /**
     * Menampilkan halaman Daftar (Sign Up) dan Masuk (Sign In) Pelanggan (L-05).
     *
     * @return \Illuminate\View\View Halaman L-05 Autentikasi Pelanggan
     */
    public function showAuth(): View
    {
        return view('auth.pelanggan');
    }

    /**
     * Mendaftarkan akun pelanggan baru dengan validasi email unik dan hash Bcrypt
     * (UC-13, KF-26, KNF-02).
     *
     * @param  \Illuminate\Http\Request         $request Data formulir pendaftaran
     * @return \Illuminate\Http\RedirectResponse         Arahkan ke halaman Sign In
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username_nama' => ['required', 'string', 'max:50'],
            'email'         => ['required', 'email', 'max:80', 'unique:akun_pelanggan,email'],
            'kata_sandi'    => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.unique'         => 'Email sudah terdaftar.',
            'kata_sandi.min'       => 'Kata sandi minimal 8 karakter.',
            'kata_sandi.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        AkunPelanggan::create([
            'username_nama'  => $validated['username_nama'],
            'email'          => $validated['email'],
            'kata_sandi'     => Hash::make($validated['kata_sandi']),
            'tanggal_daftar' => now(),
        ]);

        return redirect()->route('login')
            ->with('success', 'Akun berhasil didaftarkan! Silakan masuk.');
    }

    /**
     * Memverifikasi kredensial masuk pelanggan dengan RateLimiter maks 5x gagal (5 menit)
     * (UC-14, KF-27, KNF-02, KNF-04).
     *
     * @param  \Illuminate\Http\Request         $request Kredensial email & kata sandi
     * @return \Illuminate\Http\RedirectResponse         Redirect ke beranda atau galat
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email'      => ['required', 'email'],
            'kata_sandi' => ['required', 'string'],
        ]);

        $throttleKey = 'pelanggan-login:' . Str::lower($request->email) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'login_error' => "Terlalu banyak percobaan gagal. Coba lagi dalam {$seconds} detik.",
            ])->withInput($request->only('email'));
        }

        if (Auth::guard('pelanggan')->attempt([
            'email'    => $request->email,
            'password' => $request->kata_sandi,
        ])) {
            RateLimiter::clear($throttleKey);
            // Abaikan tujuan lama bila mengarah ke area Admin
            $tujuan = $request->session()->pull('url.intended');
            $request->session()->regenerate();
            $url = ($tujuan && ! str_contains($tujuan, '/admin')) ? $tujuan : route('beranda');

            return redirect($url)
                ->with('success', 'Selamat datang kembali di Mooolagi!');
        }

        RateLimiter::hit($throttleKey, 300);

        return back()->withErrors([
            'login_error' => 'Email atau kata sandi salah.',
        ])->withInput($request->only('email'));
    }

    /**
     * Mengakhiri sesi pelanggan aktif dan meregenerasi token CSRF (UC-14, KF-27).
     *
     * @param  \Illuminate\Http\Request         $request Permintaan logout
     * @return \Illuminate\Http\RedirectResponse         Redirect ke halaman beranda
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('pelanggan')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('beranda')->with('success', 'Anda telah keluar dari akun.');
    }
}
