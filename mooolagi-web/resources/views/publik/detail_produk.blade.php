@extends('layouts.app')
@section('title', $produk->nama . ' — Mooolagi')

@php $gambarProduk = fn ($g) => str_starts_with($g, 'http') ? $g : asset($g); @endphp

@section('content')
<div class="pt-4"><a href="{{ route('katalog') }}" class="btn btn-soft btn-sm">&larr; Kembali ke Katalog</a></div>
<div class="row g-5 py-4 mb-4">
    <div class="col-md-6">
        <div class="mo-img" style="height:380px;border-radius:20px;background-image:url('{{ $gambarProduk($produk->gambar) }}')"></div>
    </div>
    <div class="col-md-6">
        <span class="mo-chip">{{ $produk->kategori->nama_kategori ?? '-' }}</span>
        <h1 class="fw-bold mt-3" style="font-size:1.9rem;letter-spacing:-.02em">{{ $produk->nama }}</h1>
        <div class="mo-price my-3" style="font-size:1.6rem">Rp{{ number_format($produk->harga, 0, ',', '.') }}</div>
        <p style="line-height:1.7">{{ $produk->deskripsi }}</p>
        <div class="d-flex gap-2 mt-4">
            <button class="btn btn-primary px-4 py-2" type="button" disabled title="Tersedia pada Sprint 2">+ Keranjang</button>
            <a href="{{ route('kontak') }}" class="btn btn-soft px-4 py-2">Tanya via WhatsApp</a>
        </div>
        <small class="text-muted d-block mt-2">Fitur keranjang belanja tersedia pada Sprint 2.</small>
    </div>
</div>
@endsection
