@extends('layouts.app')
@section('title', 'Katalog Produk — Mooolagi')

@php $gambarProduk = fn ($g) => str_starts_with($g, 'http') ? $g : asset($g); @endphp

@section('content')
<form method="GET" action="{{ route('katalog') }}" class="d-flex flex-wrap align-items-center justify-content-between gap-3 mt-4 mb-4">
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('katalog') }}" class="mo-chip {{ request('kategori') ? '' : 'active' }}">Semua</a>
        @foreach($kategoriList as $kat)
            <a href="{{ route('katalog', ['kategori' => $kat->id_kategori]) }}"
               class="mo-chip {{ request('kategori') == $kat->id_kategori ? 'active' : '' }}">{{ $kat->nama_kategori }}</a>
        @endforeach
    </div>
    <div class="d-flex gap-2 flex-wrap">
        @if(request('kategori'))<input type="hidden" name="kategori" value="{{ request('kategori') }}">@endif
        <input type="text" name="search" class="mo-search" placeholder="Cari produk..." value="{{ request('search') }}">
        <select name="urut" class="mo-search" style="min-width:auto" onchange="this.form.submit()">
            <option value="terbaru" {{ request('urut', 'terbaru') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
            <option value="termurah" {{ request('urut') == 'termurah' ? 'selected' : '' }}>Termurah</option>
            <option value="termahal" {{ request('urut') == 'termahal' ? 'selected' : '' }}>Termahal</option>
        </select>
    </div>
</form>

@if($produkList->isEmpty())
    <div class="alert alert-warning">Produk tidak ditemukan.</div>
@else
    <div class="row g-4 mb-5">
        @foreach($produkList as $produk)
        <div class="col-lg-3 col-md-4 col-6">
            <a href="{{ route('produk.detail', $produk->id_produk) }}" class="mo-pcard">
                <div class="mo-photo" style="background-image:url('{{ $gambarProduk($produk->gambar) }}')"></div>
                <div class="info">
                    <span class="kat">{{ $produk->kategori->nama_kategori ?? '-' }}</span>
                    <h3>{{ \Illuminate\Support\Str::limit($produk->nama, 50) }}</h3>
                    <div class="price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
@endif
@endsection
