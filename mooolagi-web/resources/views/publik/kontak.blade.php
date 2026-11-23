@extends('layouts.app')
@section('title', 'Kontak — Mooolagi Creative Studio')

@php
    $digit = preg_replace('/\D/', '', $profil->nomor_wa ?? '');
    $waTampil = str_starts_with($digit, '62') ? '(+62) ' . substr($digit, 2, 3) . '-' . substr($digit, 5, 4) . '-' . substr($digit, 9) : ($digit ?: '-');
@endphp

@section('content')
<h1 class="mo-page-title">Kontak</h1>
<p class="mo-page-sub">Hubungi kami untuk pesanan custom dan konfirmasi pembayaran</p>

<div class="mo-contact">
    <h2 class="fw-bold mb-1" style="font-size:1.3rem;color:var(--cocoa-dark)">Contact Person Mooolagi</h2>
    <p class="small mb-3">Jam operasional: Senin - Sabtu, 09.00 - 18.00 WIB</p>
    <div class="item"><small>WhatsApp Helpdesk</small><strong>{{ $waTampil }}</strong><span class="small">Respon cepat untuk pemesanan &amp; konfirmasi</span></div>
    <div class="item"><small>Email Studio</small><strong>{{ $profil->kontak_lain ?? '-' }}</strong><span class="small">Untuk inquiry kerja sama &amp; pengiriman file desain</span></div>
    <div class="item"><small>Alamat Fisik Studio</small><strong>Jakarta, Indonesia 13530</strong><span class="small">Workshop produksi &amp; pengemasan hampers</span></div>
    <div class="mo-map"><span class="dot"></span><div class="pin"><strong>Mooolagi Studio</strong><br>Jakarta Timur 13530 • Ilustrasi area</div></div>
    <a href="{{ $waLink }}" target="_blank" rel="noopener" class="mo-btn mo-btn-green d-block">Hubungi Admin</a>
</div>
@endsection
