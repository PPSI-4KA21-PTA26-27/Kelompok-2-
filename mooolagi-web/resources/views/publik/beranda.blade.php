@extends('layouts.app')
@section('title', 'Beranda — Mooolagi Creative Studio')

@php $waCta = $waLink ?? '#'; @endphp

@section('full')
{{-- L-01: Hero --}}
<section class="mo-hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <span class="mo-tagpill">Creative Gift &amp; Design Studio</span>
                <h1>Setiap kado punya cerita, kami bantu bikin kejutannya.</h1>
                <p class="lead-mo">canva template, digital notepad, custom box, hingga kreasi custom blind box yang penuh kejutan. dibuat khusus untuk momen spesial kamu.</p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('katalog') }}" class="mo-btn mo-btn-green mo-btn-lg shadow">Lihat Katalog</a>
                    <a href="#tentang" class="mo-btn mo-btn-pink-outline mo-btn-lg">Lihat Tentang Kami</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative" style="height:300px;display:flex;align-items:center">
                    <svg class="mo-spark" style="top:6px;left:24px;color:var(--sunshine)" width="32" height="32" fill="currentColor" viewBox="0 0 20 20"><path d="M10 0l2.5 6.5L19 9l-6.5 2.5L10 18l-2.5-6.5L1 9l6.5-2.5L10 0z"/></svg>
                    <svg class="mo-spark" style="bottom:30px;right:30px;color:var(--sky);animation-duration:2.5s" width="24" height="24" fill="currentColor" viewBox="0 0 20 20"><path d="M10 0l2.5 6.5L19 9l-6.5 2.5L10 18l-2.5-6.5L1 9l6.5-2.5L10 0z"/></svg>
                    <div class="mo-gift"><div class="body"></div><div class="ribbon"></div><div class="lid"></div><div class="ball"></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- L-01: Layanan Kami (kategori dari tabel kategori) --}}
<section class="mo-section" id="kategori">
    <div class="container" style="max-width:900px">
        <h2 class="mo-title">Layanan Kami</h2>
        <p class="mo-subtitle">Pilih kategori sesuai kebutuhan kejutanmu</p>
        <div class="row g-3">
            @foreach($kategoriList as $kat)
            <div class="col-md-4 col-6">
                <a href="{{ route('katalog', ['kategori' => $kat->id_kategori]) }}" class="mo-cat">
                    <svg width="26" height="26" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12v9H4v-9M2 7h20v5H2zM12 21V7M12 7H7.5a2.500 2.500 0 010-5C11 2 12 7 12 7zM12 7h4.500a2.500 2.500 0 000-5C13 2 12 7 12 7z"/></svg>
                    <strong>{{ $kat->nama_kategori }}</strong>
                    <small>{{ $kat->produk_count }} produk</small>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- L-01: Tentang Mooolagi (KF-01, teks dari profil_kontak) --}}
<section class="pb-5" id="tentang">
    <div class="container text-center">
        <img src="{{ asset('images/logo.png') }}" alt="Mooolagi" style="height:64px" class="mb-3">
        <h2 class="mo-title mb-4">Tentang Mooolagi</h2>
        <div class="mo-about-card text-start">
            <p>{{ $profil->teks_profil ?? 'Mooolagi adalah Creative Gift & Design Studio yang percaya bahwa setiap hadiah punya cerita untuk disampaikan.' }}</p>
            <p class="mb-0">Setiap detail kami kerjakan dengan penuh perhatian, karena bagi kami, momen spesialmu layak dirayakan dengan cara yang paling istimewa.</p>
            <div class="mo-spes">
                <div><h4 style="color:var(--meadow)">Canva Template</h4><small>&amp; Digital Notepad</small></div>
                <div><h4 style="color:var(--bubblegum)">Custom</h4><small>Design Service</small></div>
                <div><h4 style="color:var(--sky)">Photostrip</h4><small>&amp; Study Tracker</small></div>
            </div>
            <div class="text-center">
                <p class="fw-bold small mb-2">Berlokasi di Jakarta, Indonesia</p>
                <a href="{{ route('kontak') }}" class="mo-btn mo-btn-green" style="padding:.4rem 1.1rem;font-size:.8rem">Lihat Lokasi Kami</a>
            </div>
        </div>
    </div>
</section>

{{-- L-01: Ajakan konsultasi --}}
<section class="mo-cta">
    <h2>Masih bingung memilih hadiah?</h2>
    <p>Temukan berbagai pilihan hadiah unik yang siap membuat momen spesial semakin berkesan.</p>
    <a href="{{ route('katalog') }}" class="mo-btn mo-btn-white mo-btn-lg">Ayo Lihat Produk Kami Sekarang!</a>
</section>
@endsection
