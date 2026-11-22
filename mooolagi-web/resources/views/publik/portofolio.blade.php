@extends('layouts.app')
@section('title', 'Portofolio — Mooolagi')

@php $gambarProduk = fn ($g) => str_starts_with($g, 'http') ? $g : asset($g); @endphp

@section('content')
<div class="mo-page-head">
    <h1>Portofolio Desain Mooolagi</h1>
    <p>Dokumentasi nyata hasil karya custom gift box, cetak photostrip, dan proyek template yang telah kami wujudkan untuk ratusan momen spesial pelanggan.</p>
</div>
<hr class="mo-rule">

@if($portofolio->isEmpty())
    <div class="alert alert-info">Konten belum tersedia.</div>
@else
    <div class="row g-4">
        @foreach($portofolio as $karya)
        <div class="col-md-6">
            <div class="mo-card">
                <div class="mo-img" style="height:260px;background-image:url('{{ $gambarProduk($karya->gambar) }}')"></div>
                <div class="mo-card-body">
                    <h3 style="margin-top:0">{{ $karya->judul }}</h3>
                    <p>{{ $karya->deskripsi }}</p>
                </div>
                <div class="mo-card-foot"><strong class="small">Karya Mooolagi Creative Studio</strong></div>
            </div>
        </div>
        @endforeach
    </div>
@endif

<div class="mo-cta-box my-5">
    <h3 class="fw-bold mb-2" style="font-size:1.3rem">Punya Ide Konsep Hadiah Khusus yang Belum Ada di Katalog?</h3>
    <p class="mx-auto" style="max-width:34rem">Kami melayani kustomisasi penuh dari nol, mulai dari hampers wisuda, souvenir pernikahan, hingga corporate gathering package.</p>
    <a href="{{ route('kontak') }}" class="btn btn-primary px-4 py-2">Konsultasi Kustomisasi Kado via WhatsApp</a>
</div>
@endsection
