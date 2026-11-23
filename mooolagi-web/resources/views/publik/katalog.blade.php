@extends('layouts.app')
@section('title', 'Katalog Produk — Mooolagi')

@php $gambarProduk = fn ($g) => str_starts_with($g, 'http') ? $g : asset($g); @endphp

@section('content')
<div class="mo-page-head">
    <h1>Katalog Produk Mooolagi</h1>
    <p>Cari kado impian, filter berdasarkan jenis kebutuhan, dan temukan hadiah terbaik untuk orang tersayang.</p>
</div>

<form method="GET" action="{{ route('katalog') }}" class="row g-3 align-items-start mb-2">
    <div class="col-lg-7">
        <div class="mo-filter">
            <a href="{{ route('katalog') }}" class="{{ request('kategori') ? '' : 'active' }}">Semua Produk</a>
            @foreach($kategoriList as $kat)
                <a href="{{ route('katalog', ['kategori' => $kat->id_kategori]) }}"
                   class="{{ request('kategori') == $kat->id_kategori ? 'active' : '' }}">{{ $kat->nama_kategori }}</a>
            @endforeach
        </div>
    </div>
    <div class="col-lg-5">
        @if(request('kategori'))<input type="hidden" name="kategori" value="{{ request('kategori') }}">@endif
        <div class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" class="mo-input flex-grow-1" placeholder="Cari nama produk / template..." value="{{ request('search') }}">
            <select name="urut" class="mo-input" onchange="this.form.submit()">
                <option value="terbaru" {{ request('urut', 'terbaru') == 'terbaru' ? 'selected' : '' }}>Urutkan: Terbaru</option>
                <option value="termurah" {{ request('urut') == 'termurah' ? 'selected' : '' }}>Urutkan: Termurah</option>
                <option value="termahal" {{ request('urut') == 'termahal' ? 'selected' : '' }}>Urutkan: Termahal</option>
            </select>
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </div>
</form>
<hr class="mo-rule">

@if($produkList->isEmpty())
    <div class="alert alert-warning">Produk tidak ditemukan.</div>
@else
    <div class="row g-4">
        @foreach($produkList as $produk)
        <div class="col-lg-4 col-md-6">
            <div class="mo-card">
                <div class="mo-img" style="height:240px;background-image:url('{{ $gambarProduk($produk->gambar) }}')"></div>
                <div class="mo-card-body">
                    <span class="mo-chip">{{ $produk->kategori->nama_kategori ?? '-' }}</span>
                    <h3>{{ $produk->nama }}</h3>
                    <p>{{ \Illuminate\Support\Str::limit($produk->deskripsi, 120) }}</p>
                </div>
                <div class="mo-card-foot">
                    <div><small>Harga Produk</small><span class="mo-price">Rp{{ number_format($produk->harga, 0, ',', '.') }}</span></div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('produk.detail', $produk->id_produk) }}" class="btn btn-soft">Lihat Detail</a>
                        <button class="btn btn-primary" type="button" disabled title="Tersedia pada Sprint 2">+ Keranjang</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-between align-items-center border-top mt-5 pt-4 mb-5 small">
        <span>Menampilkan {{ $produkList->count() }} produk</span>
    </div>
@endif
@endsection
