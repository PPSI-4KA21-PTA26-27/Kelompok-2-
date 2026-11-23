@extends('layouts.app')
@section('title', 'Testimoni — Mooolagi')

@section('content')
<h1 class="mo-page-title">Testimoni Pelanggan</h1>
<p class="mo-page-sub">Cerita dari mereka yang telah mempercayakan kado kejutannya kepada Mooolagi</p>

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
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="mo-avatar">{{ $inisial }}</span>
                    <div>
                        <strong style="font-family:'Fredoka',sans-serif">{{ $t->nama_pemberi }}</strong>
                        <div class="small" style="opacity:.65">{{ \Carbon\Carbon::parse($t->tanggal)->locale('id')->translatedFormat('d F Y') }}</div>
                    </div>
                </div>
                <div style="color:var(--sunshine);letter-spacing:2px">★★★★★</div>
                <p class="fst-italic mt-2 mb-0">“{{ $t->isi_testimoni }}”</p>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
