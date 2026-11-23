@extends('layouts.app')
@section('title', $produk->nama . ' — Mooolagi')

@php $gambarProduk = fn ($g) => str_starts_with($g, 'http') ? $g : asset($g); @endphp

@section('content')
<div class="pt-4"><a href="{{ route('katalog') }}" class="mo-chip">&larr; Kembali ke Katalog</a></div>
<div class="row g-5 py-4 mb-4">
    <div class="col-md-6">
        <div class="mo-photo" style="height:380px;border-radius:20px;border:2px solid var(--sky-light);background-image:url('{{ $gambarProduk($produk->gambar) }}')"></div>
    </div>
    <div class="col-md-6">
        <span style="color:var(--bubblegum);font-family:'Fredoka',sans-serif;font-weight:600">{{ $produk->kategori->nama_kategori ?? '-' }}</span>
        <h1 class="fw-bold mt-1" style="font-size:1.9rem;color:var(--meadow-dark)">{{ $produk->nama }}</h1>
        <div class="my-3 fw-bold" style="font-size:1.6rem;color:var(--meadow-dark)">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
        <p style="line-height:1.7">{{ $produk->deskripsi }}</p>
        <div class="d-flex gap-2 flex-wrap mt-4">
            <button class="mo-btn mo-btn-green mo-btn-lg" type="button" disabled title="Tersedia pada Sprint 2">Tambah ke Keranjang</button>
            <a href="{{ route('kontak') }}" class="mo-btn mo-btn-pink-outline mo-btn-lg">Tanya via WhatsApp</a>
        </div>
        <small class="d-block mt-2" style="opacity:.7">Fitur keranjang belanja tersedia pada Sprint 2.</small>
    </div>
</div>
@endsection
