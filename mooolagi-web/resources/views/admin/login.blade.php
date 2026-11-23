@extends('layouts.polos')
@section('title', 'Login Admin — Mooolagi')
@section('body_class', 'mo-admin')

@section('content')
<div class="mo-admin-card" style="margin-top:3rem">
    <div class="text-center mb-3">
        <img src="{{ asset('images/logo.png') }}" alt="Mooolagi" style="height:52px">
        <h2 class="fw-bold mt-2" style="font-size:1.4rem;color:#222;font-family:'Plus Jakarta Sans',sans-serif">Login Admin</h2>
    </div>
    @if($errors->has('admin_error'))
        <div class="alert alert-danger py-2 small">{{ $errors->first('admin_error') }}</div>
    @endif
    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label small fw-semibold" style="color:#333">Alamat email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required style="border-color:#ddd">
        </div>
        <div class="mb-3">
            <label class="form-label small fw-semibold" style="color:#333">Kata sandi <span class="text-danger">*</span></label>
            <input type="password" name="kata_sandi" class="form-control" required style="border-color:#ddd">
        </div>
        <button class="mo-btn mo-btn-green w-100 mt-2" type="submit" style="border-radius:8px;font-family:'Plus Jakarta Sans',sans-serif">Masuk</button>
    </form>
    <p class="small text-center mt-3 mb-0" style="color:#777">Login dikunci 5 menit setelah 5 kali gagal berturut-turut.</p>
    <a href="{{ route('beranda') }}" class="mo-back">← Kembali ke Tampilan Web Publik</a>
</div>
@endsection
