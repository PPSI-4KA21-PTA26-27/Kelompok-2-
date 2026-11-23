@extends('layouts.app')
@section('title', 'Testimoni — Mooolagi')

@section('content')
<div class="mo-page-head">
    <h1>Cerita &amp; Testimoni Pelanggan</h1>
    <p>Inspirasi nyata dari mereka yang telah mempercayakan pembuatan kado kejutan, template, dan hampers personal kepada Mooolagi Studio.</p>
</div>
<hr class="mo-rule">

<div class="mo-stat mb-4">
    <div class="row text-center g-3">
        <div class="col-md-4"><strong>4.9 / 5.0</strong><span>Rata-rata Skor Kepuasan</span></div>
        <div class="col-md-4"><strong>150+</strong><span>Kado Kejutan Terkirim</span></div>
        <div class="col-md-4"><strong>100%</strong><span>Jaminan Sentuhan Personal</span></div>
    </div>
</div>

@if($testimoni->isEmpty())
    <div class="alert alert-info">Konten belum tersedia.</div>
@else
    <div class="row g-4 mb-5">
        @foreach($testimoni as $t)
        @php
            $inisial = collect(preg_split('/[\s&]+/', trim($t->nama_pemberi)))->filter()->take(2)
                ->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->implode('');
        @endphp
        <div class="col-lg-4 col-md-6">
            <div class="mo-testi">
                <div class="d-flex align-items-center gap-3">
                    <span class="mo-avatar">{{ $inisial }}</span>
                    <strong>{{ $t->nama_pemberi }}</strong>
                </div>
                <div class="d-flex justify-content-between align-items-center border-top border-bottom my-3 py-2">
                    <span class="mo-stars">★★★★★ 5/5</span>
                    <small>{{ \Carbon\Carbon::parse($t->tanggal)->locale('id')->translatedFormat('d F Y') }}</small>
                </div>
                <blockquote>“{{ $t->isi_testimoni }}”</blockquote>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
