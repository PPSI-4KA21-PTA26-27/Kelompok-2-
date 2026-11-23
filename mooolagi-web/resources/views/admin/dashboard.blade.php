@extends('layouts.app')
@section('title', 'Dashboard Admin — Mooolagi')

@section('content')
<div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mt-4">
    <div>
        <h1 class="mo-page-title text-start mt-0 mb-1">Dashboard Admin</h1>
        <p>Selamat datang, <strong>{{ Auth::guard('admin')->user()->nama }}</strong>. Antrean pesanan dan pengelolaan konten dilanjutkan pada Sprint 2 dan 3.</p>
    </div>
    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button class="mo-btn mo-btn-pink" type="submit">Keluar (Admin)</button>
    </form>
</div>
<div class="row g-4 my-3 mb-5">
    <div class="col-md-4"><div class="mo-stat"><strong>{{ $totalProduk }}</strong>Total Produk</div></div>
    <div class="col-md-4"><div class="mo-stat"><strong>{{ $totalKategori }}</strong>Total Kategori</div></div>
    <div class="col-md-4"><div class="mo-stat"><strong>{{ $totalPelanggan }}</strong>Pelanggan Terdaftar</div></div>
</div>
@endsection
