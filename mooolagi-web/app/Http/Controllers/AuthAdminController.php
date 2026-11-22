<?php

namespace App\Http\Controllers;

use App\Models\AkunPelanggan;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthAdminController extends Controller
{
    /**
     * Menampilkan halaman Login khusus Dashboard Admin (L-10).
     *
     * @return \Illuminate\View\View Halaman L-10 Login Admin
     */
    public function showLogin(): View
    {
        return view('admin.login');
    }

    /**
     * Memverifikasi kredensial Admin dengan guard auth:admin dan RateLimiter 5x gagal
     * (UC-06, KF-17, KNF-02, KNF-04).
     *
     * @param  \Illuminate\Http\Request         $request Kredensial email & kata sandi Admin
     * @return \Illuminate\Http\RedirectResponse         Redirect ke dashboard Admin
     */
    public function loginAdmin(Request $request): RedirectResponse
    {
        $request->validate([
            'email'      => ['required', 'email'],
            'kata_sandi' => ['required', 'string'],
        ]);

        $throttleKey = 'admin-login:' . Str::lower($request->email) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'admin_error' => "Akses terkunci sementara (5x gagal). Coba lagi dalam {$seconds} detik.",
            ])->withInput($request->only('email'));
        }

        if (Auth::guard('admin')->attempt([
            'email'    => $request->email,
            'password' => $request->kata_sandi,
        ])) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        RateLimiter::hit($throttleKey, 300);

        return back()->withErrors([
            'admin_error' => 'Email atau kata sandi Admin tidak valid.',
        ])->withInput($request->only('email'));
    }

    /**
     * Menampilkan kerangka Dashboard Admin setelah login berhasil (Sprint 1).
     *
     * @return \Illuminate\View\View Halaman kerangka Dashboard Admin
     */
    public function dashboard(): View
    {
        $totalProduk = Produk::count();
        $totalKategori = Kategori::count();
        $totalPelanggan = AkunPelanggan::count();

        return view('admin.dashboard', compact('totalProduk', 'totalKategori', 'totalPelanggan'));
    }

    /**
     * Mengakhiri sesi Admin (UC-06).
     *
     * @param  \Illuminate\Http\Request         $request Permintaan logout Admin
     * @return \Illuminate\Http\RedirectResponse         Redirect ke halaman login Admin
     */
    public function logoutAdmin(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Berhasil keluar dari Dashboard Admin.');
    }
}
