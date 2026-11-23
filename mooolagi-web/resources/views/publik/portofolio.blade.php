@extends('layouts.app')
@section('title', 'Portfolio — Mooolagi')

@php $gambarProduk = fn ($g) => str_starts_with($g, 'http') ? $g : asset($g); @endphp

@section('content')
<h1 class="mo-page-title">Portfolio Kami</h1>
<p class="mo-page-sub">Beberapa karya yang pernah kami wujudkan</p>

@if($portofolio->isEmpty())
    <div class="alert alert-info">Konten belum tersedia.</div>
@else
    <div class="row g-4 mb-5 justify-content-center">
        @foreach($portofolio as $karya)
        <div class="col-lg-4 col-md-6">
            <div class="mo-pcard" style="cursor:default">
                <div class="mo-photo" style="height:240px;background-image:url('{{ $gambarProduk($karya->gambar) }}')"></div>
                <div class="info">
                    <h3>{{ $karya->judul }}</h3>
                    <p class="small mb-0" style="opacity:.75">{{ \Illuminate\Support\Str::limit($karya->deskripsi, 110) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
