@extends('layouts.polos')
@section('title', 'Login Admin — Mooolagi')

@section('content')
<div class="text-center mb-3"><span class="mo-pill fw-bold">Mooolagi Studio Manager</span></div>
<div class="mx-auto" style="max-width:480px">
    <div class="mo-auth-card">
        <div class="text-center">
            <span class="badge" style="background:var(--mo-purple);letter-spacing:.06em;font-size:.65rem">PORTAL KEAMANAN INTERNAL</span>
            <h2 class="mt-3" style="font-size:1.5rem">Login Administrator</h2>
            <p class="small">Akses khusus pengelola Mooolagi Creative Studio.</p>
        </div>
        <hr>
        @if($errors->has('admin_error'))
            <div class="alert alert-danger">{{ $errors->first('admin_error') }}</div>
        @endif
        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="mb-3">
                <label class="mo-label">Email Administrator Resmi *</label>
                <input type="email" name="email" class="mo-input w-100" value="{{ old('email') }}" required>
            </div>
            <div class="mb-4">
                <label class="mo-label">Kata Sandi Administrator *</label>
                <input type="password" name="kata_sandi" class="mo-input w-100" required>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Masuk ke Dashboard Admin →</button>
        </form>
        <div class="mo-warn mt-4">
            <strong>[PERINGATAN KEAMANAN]:</strong><br>
            Akses login akan dikunci sementara selama 5 menit setelah 5 kali kegagalan kata sandi berturut-turut.
        </div>
        <hr>
        <p class="text-center small mb-0"><a href="{{ route('beranda') }}">← Kembali ke Tampilan Web Publik</a></p>
    </div>
</div>
<p class="text-center small mt-3 mb-0" style="color:var(--mo-muted)">&copy; 2026 Mooolagi Creative Gift Studio • Area Terbatas Administrator</p>
@endsection
