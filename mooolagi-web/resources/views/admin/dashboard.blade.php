@extends('layouts.app')
@section('title', 'Dashboard Admin — Mooolagi')

@section('content')
<div class="mo-page-head d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>Dashboard Admin Mooolagi</h1>
        <p>Selamat datang, <strong>{{ Auth::guard('admin')->user()->nama }}</strong>. Antrean pesanan dan pengelolaan konten dilanjutkan pada Sprint 2 dan 3.</p>
    </div>
    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button class="btn btn-soft" type="submit">Keluar (Admin)</button>
    </form>
</div>
<hr class="mo-rule">
<div class="row g-4 mb-5">
    <div class="col-md-4"><div class="mo-stat"><strong>{{ $totalProduk }}</strong><span>Total Produk</span></div></div>
    <div class="col-md-4"><div class="mo-stat"><strong>{{ $totalKategori }}</strong><span>Total Kategori</span></div></div>
    <div class="col-md-4"><div class="mo-stat"><strong>{{ $totalPelanggan }}</strong><span>Pelanggan Terdaftar</span></div></div>
</div>
@endsection
