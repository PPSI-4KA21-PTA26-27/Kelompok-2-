@extends('layouts.app')
@section('title', 'Kontak — Mooolagi Creative Studio')

@php
    $digit = preg_replace('/\D/', '', $profil->nomor_wa ?? '');
    $waTampil = str_starts_with($digit, '62') ? '(+62) ' . substr($digit, 2, 3) . '-' . substr($digit, 5, 4) . '-' . substr($digit, 9) : ($digit ?: '-');
@endphp

@section('content')
<div class="mo-page-head">
    <h1>Hubungi Mooolagi Studio</h1>
    <p>Punya pertanyaan mengenai pesanan custom, konfirmasi transfer manual, atau kolaborasi bisnis? Tim kami siap merespons dengan cepat.</p>
</div>
<hr class="mo-rule">

<div class="row g-4 mb-5">
    <div class="col-lg-5">
        <div class="mo-contact-card">
            <span class="mo-chip mb-3 d-inline-block" style="font-size:.65rem;letter-spacing:.05em;text-transform:uppercase">Saluran Komunikasi Resmi</span>
            <h2 class="fw-bold" style="font-size:1.3rem">Contact Person Mooolagi</h2>
            <p class="small">Jam operasional: Senin - Sabtu, 09.00 - 18.00 WIB</p>
            <div class="item"><small>WhatsApp Helpdesk</small><strong>{{ $waTampil }}</strong><span class="small">Respon cepat untuk pemesanan &amp; konfirmasi</span></div>
            <div class="item"><small>Email Studio</small><strong>{{ $profil->kontak_lain ?? '-' }}</strong><span class="small">Untuk inquiry kerja sama &amp; pengiriman file desain</span></div>
            <div class="item border-0"><small>Alamat Fisik Studio</small><strong>Jakarta, Indonesia 13530</strong><span class="small">Workshop produksi &amp; pengemasan hampers</span></div>
            <a href="{{ $waLink }}" target="_blank" rel="noopener" class="btn btn-primary w-100 py-2 mt-3">Buka WhatsApp Admin Langsung</a>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="mo-map mb-4">
            <div class="bar"><span>Lokasi Studio • Jakarta Timur 13530</span><span>Koordinat Studio</span></div>
            <div class="canvas"><span class="dot"></span><div class="pin"><strong>Mooolagi Studio</strong><br>Jakarta Timur 13530 • Ilustrasi area</div></div>
        </div>
        <div class="mo-form">
            <h3 class="fw-bold mb-3" style="font-size:1.1rem">Kirim Pesan / Permintaan Informasi Cepat</h3>
            {{-- Pesan dikirim lewat WhatsApp Admin (sesuai SRS: komunikasi via tautan wa.me); tidak disimpan di basis data --}}
            <form id="formPesan" class="row g-3">
                <div class="col-md-6"><label class="mo-label">Nama Anda *</label><input id="fNama" class="mo-input w-100" required placeholder="Nama Anda"></div>
                <div class="col-md-6"><label class="mo-label">Email Anda *</label><input id="fEmail" type="email" class="mo-input w-100" required placeholder="email@example.com"></div>
                <div class="col-12"><label class="mo-label">Subjek Pertanyaan</label><input id="fSubjek" class="mo-input w-100" placeholder="Tanya kustomisasi hampers wisuda"></div>
                <div class="col-12"><label class="mo-label">Isi Pesan</label><textarea id="fIsi" class="mo-input w-100" rows="4" placeholder="Tulis pesan Anda"></textarea></div>
                <div class="col-12"><button class="btn btn-primary px-4 py-2" type="submit">Kirim Pesan ke Tim Studio</button></div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('formPesan').addEventListener('submit', function (e) {
        e.preventDefault();
        var teks = 'Halo Mooolagi Studio.\nNama: ' + fNama.value + '\nEmail: ' + fEmail.value +
                   '\nSubjek: ' + fSubjek.value + '\n\n' + fIsi.value;
        var base = @json($waLink);
        window.open(base + (base.indexOf('?') > -1 ? '&' : '?') + 'text=' + encodeURIComponent(teks), '_blank');
    });
</script>
@endsection
