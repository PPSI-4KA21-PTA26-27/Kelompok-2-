@extends('layouts.polos')
@section('title', 'Masuk & Daftar Akun — Mooolagi')

@section('content')
<div class="row g-4 justify-content-center align-items-start">
    {{-- UC-14: Sign In --}}
    <div class="col-lg-4 col-md-6" style="margin-top:2.5rem">
        <div class="text-center mb-2"><a href="{{ route('beranda') }}"><img src="{{ asset('images/logo.png') }}" alt="Mooolagi" style="height:56px"></a></div>
        <div class="mo-auth-card">
            <h2>Selamat Datang Kembali!</h2>
            @if($errors->has('login_error'))
                <div class="alert alert-danger py-2 small">{{ $errors->first('login_error') }}</div>
            @endif
            <form method="POST" action="{{ route('pelanggan.login') }}">
                @csrf
                <div class="mb-3">
                    <label class="mo-label">Email</label>
                    <input type="email" name="email" class="mo-field" value="{{ old('email') }}" required>
                </div>
                <div class="mb-4">
                    <label class="mo-label">Password</label>
                    <input type="password" name="kata_sandi" class="mo-field" required>
                </div>
                <button class="mo-btn mo-btn-green w-100" type="submit">Masuk</button>
            </form>
            <p class="text-center small mt-3 mb-0" style="opacity:.8">Belum punya akun? <a href="#daftar" style="color:var(--bubblegum);font-weight:600">Daftar di sini</a></p>
        </div>
        <a href="{{ route('beranda') }}" class="mo-back">← Kembali ke Beranda</a>
    </div>

    {{-- UC-13: Sign Up --}}
    <div class="col-lg-4 col-md-6" id="daftar">
        <div class="text-center mb-2"><a href="{{ route('beranda') }}"><img src="{{ asset('images/logo.png') }}" alt="Mooolagi" style="height:56px"></a></div>
        <div class="mo-auth-card">
            <h2>Buat Akun Baru</h2>
            @if($errors->any() && !$errors->has('login_error'))
                <div class="alert alert-danger py-2 small">
                    <ul class="mb-0 ps-3">@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
                </div>
            @endif
            <form method="POST" action="{{ route('pelanggan.register') }}">
                @csrf
                <div class="mb-3">
                    <label class="mo-label">Nama Lengkap</label>
                    <input type="text" name="username_nama" class="mo-field" value="{{ old('username_nama') }}" required>
                </div>
                <div class="mb-3">
                    <label class="mo-label">Email</label>
                    <input type="email" name="email" class="mo-field" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                    <label class="mo-label">Password (minimal 8 karakter)</label>
                    <input type="password" name="kata_sandi" class="mo-field" required>
                </div>
                <div class="mb-4">
                    <label class="mo-label">Konfirmasi Password</label>
                    <input type="password" name="kata_sandi_confirmation" class="mo-field" required>
                </div>
                <button class="mo-btn mo-btn-pink w-100" type="submit">Daftar Sekarang</button>
            </form>
            <p class="text-center small mt-3 mb-0" style="opacity:.8">Sudah punya akun? <a href="{{ route('login') }}" style="color:var(--meadow);font-weight:600">Masuk di sini</a></p>
        </div>
        <a href="{{ route('beranda') }}" class="mo-back">← Kembali ke Beranda</a>
    </div>
</div>
@endsection
