@extends('layouts.app')
@section('title', 'Beranda — Mooolagi Creative Studio')

@php
    $foto = fn ($file) => file_exists(public_path('images/' . $file))
        ? "background-image: url('" . asset('images/' . $file) . "')" : '';
    $gambarProduk = fn ($g) => str_starts_with($g, 'http') ? $g : asset($g);

    $layanan = [
        ['chip' => 'Digital File',        'judul' => 'Canva Template Bundle',    'file' => 'kategori-canva.jpg',
         'isi' => '35+ template scrapbook & e-card siap edit instan untuk momen anniversary.'],
        ['chip' => 'Fisik / Best Seller', 'judul' => 'Custom Mystery Blind Box', 'file' => 'kategori-blindbox.jpg',
         'isi' => 'Kotak kado misteri dengan 4–6 item personal: keychain, photostrip & mini surat.'],
        ['chip' => 'Cetak Foto',          'judul' => 'Custom Photostrip Pack',   'file' => 'kategori-photostrip.jpg',
         'isi' => 'Cetak foto strip ala photobooth Korea laminasi doff tahan air.'],
        ['chip' => 'Aplikasi Tablet',     'judul' => 'Digital Notepad & Tracker', 'file' => 'kategori-notepad.jpg',
         'isi' => 'Planner digital interaktif PDF hyperlink untuk GoodNotes & Notability.'],
    ];
    $waCta = $waLink ?? '#';
@endphp

@section('full')
{{-- L-01: Hero --}}
<section class="mo-hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="mo-pill">Creative Gift &amp; Design Studio — Jakarta</span>
                <h1>Setiap kado punya cerita,<br>kami bantu bikin kejutannya.</h1>
                <p class="lead-mo">canva template, digital notepad, custom box, hingga kreasi custom blind box yang penuh kejutan. dibuat khusus untuk momen spesial kamu.</p>
                <div class="d-flex flex-wrap gap-2 mt-4">
                    <a href="{{ route('katalog') }}" class="btn btn-primary px-4 py-2">Lihat Katalog Produk</a>
                    <a href="#tentang" class="btn btn-soft px-4 py-2">Pelajari Tentang Kami</a>
                </div>
                <div class="mo-trust">
                    <span>100% Custom &amp; Personal</span>
                    <span>Bahan Premium Terpilih</span>
                    <span>Kirim ke Seluruh Indonesia</span>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="mo-photo">
                    <div class="mo-img" style="{{ $foto('hero-giftbox.jpg') }}"></div>
                    <small>Mystery Box • Custom Scrapbook • Photostrip</small>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- L-01: Layanan unggulan --}}
<section class="mo-lilac">
    <div class="container">
        <div class="text-center mb-5">
            <div class="mo-eyebrow mb-2">Layanan Unggulan</div>
            <h2>Pilih Kategori Sesuai Rencana Kejutanmu</h2>
            <p class="small mb-0">Solusi hadiah mulai dari kreasi fisik sampai desain digital instan</p>
        </div>
        <div class="row g-4">
            @foreach($layanan as $l)
            <div class="col-lg-3 col-md-6">
                <div class="mo-cat">
                    <div class="mo-img" style="{{ $foto($l['file']) }}"></div>
                    <div class="px-2 pt-1 d-flex flex-column flex-grow-1">
                        <div class="mt-2"><span class="mo-chip">{{ $l['chip'] }}</span></div>
                        <h3>{{ $l['judul'] }}</h3>
                        <p>{{ $l['isi'] }}</p>
                        <a href="{{ route('katalog') }}" class="mo-more"><span>Lihat Produk &amp; Harga</span><span>→</span></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- L-01: Rekomendasi produk (data dari tabel produk) --}}
<section class="mo-sec">
    <div class="container">
        <div class="mo-sec-head">
            <div>
                <div class="mo-eyebrow mb-1">Paling Diminati</div>
                <h2 class="mb-0">Rekomendasi Produk Pilihan</h2>
            </div>
            <a href="{{ route('katalog') }}" class="btn btn-soft btn-sm px-3">Buka Semua Katalog ({{ $totalProduk ?? $produkUnggulan->count() }} Produk) →</a>
        </div>
        <div class="row g-4">
            @foreach($produkUnggulan->take(3) as $p)
            <div class="col-lg-4 col-md-6">
                <div class="mo-card" style="border-radius:18px">
                    <div class="mo-img" style="background-image:url('{{ $gambarProduk($p->gambar) }}')"></div>
                    <div class="mo-card-body">
                        <span class="mo-chip">{{ $p->kategori->nama_kategori ?? '-' }}</span>
                        <h3>{{ $p->nama }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit($p->deskripsi, 90) }}</p>
                    </div>
                    <div class="mo-card-foot">
                        <div><small>Harga Satuan</small><span class="mo-price">Rp{{ number_format($p->harga, 0, ',', '.') }}</span></div>
                        <a href="{{ route('produk.detail', $p->id_produk) }}" class="btn btn-primary">Rincian Produk</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- L-01: Tentang kami (KF-01, teks dari profil_kontak) --}}
<section class="mo-sec pt-0" id="tentang">
    <div class="container">
        <div class="mo-sec-head">
            <div>
                <div class="mo-eyebrow mb-1">Tentang Kami</div>
                <h2 class="mb-0">Mooolagi Creative Studio</h2>
            </div>
        </div>
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="mo-img" style="height:300px;border-radius:20px;{{ $foto('tentang-studio.jpg') }}"></div>
            </div>
            <div class="col-lg-6">
                <p class="small mb-2">Mengenal kami lebih dekat</p>
                <h3 class="fw-bold mb-3">Lebih dari Sekadar Kado, Kami Merangkai Cerita.</h3>
                <p>{{ $profil->teks_profil ?? 'Mooolagi adalah Creative Gift & Design Studio yang percaya bahwa setiap hadiah punya cerita untuk disampaikan.' }}</p>
            </div>
        </div>

        <div class="text-center mt-5 mb-3 mo-eyebrow">3 Spesialisasi Kreasi Mooolagi</div>
        <div class="row g-4">
            <div class="col-md-4"><div class="mo-spes"><div class="mo-img" style="{{ $foto('produk-canva.jpg') }}"></div><h4>Canva Template &amp; Notepad</h4><p>File digital instan, mudah dikustomisasi di Canva &amp; tablet</p></div></div>
            <div class="col-md-4"><div class="mo-spes"><div class="mo-img" style="{{ $foto('produk-hampers.jpg') }}"></div><h4>Custom Mystery Blind Box</h4><p>Kurasi item kejutan rahasia, pita satin eksklusif</p></div></div>
            <div class="col-md-4"><div class="mo-spes"><div class="mo-img" style="{{ $foto('produk-photostrip.jpg') }}"></div><h4>Photostrip &amp; Tracker</h4><p>Cetak foto tebal 310gsm laminasi doff tahan gores &amp; air</p></div></div>
        </div>
        <hr class="mo-rule">
        <div class="row g-4 mo-keunggulan">
            <div class="col-md-4"><h5>1. Perhatian pada Detail</h5><p>Setiap pita, kartu ucapan, dan pemilihan warna dikerjakan dengan presisi tangan.</p></div>
            <div class="col-md-4"><h5>2. Kemasan Aman &amp; Rapi</h5><p>Menggunakan kardus ganda dan pengaman bubble tebal agar hadiah tiba tanpa cacat.</p></div>
            <div class="col-md-4"><h5>3. Layanan Ramah &amp; Cepat</h5><p>Dukungan chat WhatsApp responsif untuk konsultasi request khusus.</p></div>
        </div>
        <p class="text-center small mt-4 mb-0">Studio Operasional: Jakarta Timur, DKI Jakarta 13530 • Pengiriman Seluruh Nusantara</p>
    </div>
</section>

{{-- L-01: Ajakan konsultasi --}}
<section class="mo-cta">
    <div class="container">
        <span class="mo-pill">Konsultasi Hadiah Bebas Ribet</span>
        <h2>Masih Bingung Memilih Format Kado yang Tepat?</h2>
        <p class="mx-auto" style="max-width:40rem">Diskusikan ide kejutanmu dengan desainer Mooolagi via WhatsApp. Kami siap merekomendasikan template, custom box, atau kombinasi hadiah yang paling berkesan.</p>
        <div class="d-flex justify-content-center flex-wrap gap-2 mt-4">
            <a href="{{ route('katalog') }}" class="btn btn-primary px-4 py-2">Lihat Semua Produk di Katalog</a>
            <a href="{{ $waCta }}" target="_blank" rel="noopener" class="btn btn-light px-4 py-2">Konsultasi via WhatsApp Studio</a>
        </div>
    </div>
</section>
@endsection
