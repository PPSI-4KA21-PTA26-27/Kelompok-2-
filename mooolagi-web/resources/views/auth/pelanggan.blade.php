@extends('layouts.polos')
@section('title', 'Masuk & Daftar Akun — Mooolagi')

@section('content')
<div class="text-center mb-5">
    <a href="{{ route('beranda') }}" class="mo-brand d-inline-block mb-3">mooolagi.</a>
    <h1 class="fw-bold" style="font-size:2rem;letter-spacing:-.02em">Akun Pelanggan Mooolagi</h1>
    <p class="mx-auto mb-0" style="max-width:38rem">Masuk atau daftarkan akun baru untuk menyimpan keranjang belanja, checkout pengiriman kado, dan memantau status pembuatan pesanan.</p>
</div>

<div class="row g-4 justify-content-center">
    {{-- UC-14: Sign In --}}
    <div class="col-lg-5">
        <div class="mo-auth-card">
            <h2>Masuk ke Akun Pelanggan</h2>
            <p class="small">Gunakan email aktif dan kata sandi terdaftar.</p>
            <hr>
            @if($errors->has('login_error'))
                <div class="alert alert-danger">{{ $errors->first('login_error') }}</div>
            @endif
            <form method="POST" action="{{ route('pelanggan.login') }}">
                @csrf
                <div class="mb-3">
                    <label class="mo-label">Email Aktif *</label>
                    <input type="email" name="email" class="mo-input w-100" value="{{ old('email') }}" placeholder="pelanggan@example.com" required>
                </div>
                <div class="mb-4">
                    <label class="mo-label">Kata Sandi *</label>
                    <input type="password" name="kata_sandi" class="mo-input w-100" required>
                </div>
                <button class="btn btn-primary w-100 py-2" type="submit">Masuk ke Akun</button>
            </form>
            <hr class="mt-4">
            <p class="text-center small mb-0">Belum punya akun? <a href="#daftar">Daftar di sini</a></p>
        </div>
    </div>

    {{-- UC-13: Sign Up --}}
    <div class="col-lg-5" id="daftar">
        <div class="mo-auth-card">
            <h2>Daftar Akun Baru</h2>
            <p class="small">Lengkapi data untuk kemudahan pemesanan &amp; tracking.</p>
            <hr>
            @if($errors->any() && !$errors->has('login_error'))
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('pelanggan.register') }}">
                @csrf
                <div class="mb-3">
                    <label class="mo-label">Nama Lengkap / Username *</label>
                    <input type="text" name="username_nama" class="mo-input w-100" value="{{ old('username_nama') }}" required>
                </div>
                <div class="mb-3">
                    <label class="mo-label">Email Aktif *</label>
                    <input type="email" name="email" class="mo-input w-100" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                    <label class="mo-label">Kata Sandi (Minimal 8 Karakter) *</label>
                    <input type="password" name="kata_sandi" class="mo-input w-100" required>
                </div>
                <div class="mb-4">
                    <label class="mo-label">Ulangi Konfirmasi Kata Sandi *</label>
                    <input type="password" name="kata_sandi_confirmation" class="mo-input w-100" required>
                </div>
                <button class="btn btn-primary w-100 py-2" type="submit">Daftarkan Akun Baru</button>
            </form>
        </div>
    </div>
</div>
@endsection
