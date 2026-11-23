<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mooolagi Creative Studio')</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/mooolagi.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
@php
    // Data kontak footer dari tabel profil_kontak; nilai bawaan dipakai bila belum ada data
    $kontakFooter = \App\Models\ProfilKontak::first();
    $waDigit = preg_replace('/\D/', '', $kontakFooter->nomor_wa ?? '6289603961169');
    $waTampil = str_starts_with($waDigit, '62')
        ? '(+62) ' . substr($waDigit, 2, 3) . '-' . substr($waDigit, 5, 4) . '-' . substr($waDigit, 9)
        : $waDigit;
    $emailFooter = $kontakFooter->kontak_lain ?? 'helpdesk@mooolagi.my.id';
@endphp
    <header class="mo-header">
        <div class="container">
            <div class="bar">
                <a href="{{ route('beranda') }}"><img class="logo" src="{{ asset('images/logo.png') }}" alt="Mooolagi"></a>

                <nav class="mo-nav">
                    <a href="{{ route('katalog') }}" class="{{ request()->routeIs('katalog', 'produk.detail') ? 'active' : '' }}">Katalog</a>
                    <a href="{{ route('portofolio') }}" class="{{ request()->routeIs('portofolio') ? 'active' : '' }}">Portfolio</a>
                    <a href="{{ route('testimoni') }}" class="{{ request()->routeIs('testimoni') ? 'active' : '' }}">Testimoni</a>
                    <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
                </nav>

                <div class="mo-auth desk">
                    @if(Auth::guard('pelanggan')->check())
                        <span class="small fw-semibold">Halo, {{ Auth::guard('pelanggan')->user()->username_nama }}</span>
                        <form action="{{ route('pelanggan.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="mo-btn mo-btn-pink">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="mo-btn mo-btn-outline">Masuk</a>
                        <a href="{{ route('register') }}" class="mo-btn mo-btn-green">Daftar</a>
                    @endif
                </div>

                <button class="mo-burger d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#menuHp" aria-label="Buka menu">
                    <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
        <div class="collapse d-md-none" id="menuHp">
            <div class="mo-mobile">
                <a href="{{ route('katalog') }}">Katalog</a>
                <a href="{{ route('portofolio') }}">Portfolio</a>
                <a href="{{ route('testimoni') }}">Testimoni</a>
                <a href="{{ route('kontak') }}">Kontak</a>
                @if(Auth::guard('pelanggan')->check())
                    <form action="{{ route('pelanggan.logout') }}" method="POST">@csrf
                        <button type="submit" class="border-0 bg-transparent p-0 fw-semibold" style="color:var(--bubblegum)">Keluar</button></form>
                @else
                    <a href="{{ route('login') }}" class="fw-semibold" style="color:var(--meadow)">Masuk</a>
                    <a href="{{ route('register') }}" class="fw-semibold" style="color:var(--bubblegum)">Daftar</a>
                @endif
            </div>
        </div>
    </header>

    <main class="flex-grow-1">
        @if(session('success') || session('error'))
            <div class="container pt-3">
                @if(session('success'))<div class="alert alert-success mb-0">{{ session('success') }}</div>@endif
                @if(session('error'))<div class="alert alert-danger mb-0">{{ session('error') }}</div>@endif
            </div>
        @endif

        @hasSection('full')
            @yield('full')
        @else
            <div class="container">
                @yield('content')
            </div>
        @endif
    </main>

    <footer class="mo-footer">
        <div class="container inner">
            <div class="row g-4">
                <div class="col-md-4">
                    <img class="logo" src="{{ asset('images/logo.png') }}" alt="Mooolagi">
                    <p>Creative Gift &amp; Design Studio — Hampers, Gift Box, Custom Gift, Merchandise, Souvenir, Design Service, dan Packaging.</p>
                    <div class="mt-3">
                        <a class="soc" href="https://www.instagram.com/mooolagi/" target="_blank" rel="noopener" aria-label="Instagram">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM12 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zm0 10.162a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                        </a>
                        <a class="soc" href="https://www.tiktok.com/@mooolagi_id" target="_blank" rel="noopener" aria-label="TikTok">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M16.6 5.82s.51.5 0 0A4.278 4.278 0 0 1 15.54 3h-3.09v12.4a2.592 2.592 0 0 1-2.59 2.5c-1.42 0-2.6-1.16-2.6-2.6 0-1.72 1.66-3.01 3.37-2.48V9.66c-3.45-.46-6.47 2.22-6.47 5.64 0 3.33 2.76 5.7 5.69 5.7 3.14 0 5.69-2.55 5.69-5.7V9.01a7.35 7.35 0 0 0 4.3 1.38V7.3s-1.88.09-3.24-1.48z"/></svg>
                        </a>
                        <a class="soc" href="https://shopee.co.id/mooolagi" target="_blank" rel="noopener" aria-label="Shopee">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 2l1.5 3.5M18 2l-1.5 3.5M3.5 8h17l-1 12a2 2 0 0 1-2 1.8H6.5a2 2 0 0 1-2-1.8l-1-12z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11a3.5 3.5 0 0 0 7 0"/></svg>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3>Layanan</h3>
                    <ul>
                        <li><a href="{{ route('katalog') }}">Hampers</a></li>
                        <li><a href="{{ route('katalog') }}">Gift Box</a></li>
                        <li><a href="{{ route('katalog') }}">Custom Gift</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3>Kontak</h3>
                    <ul>
                        <li><a href="https://wa.me/{{ $waDigit }}" target="_blank" rel="noopener">{{ $waTampil }}</a></li>
                        <li>{{ $emailFooter }}</li>
                        <li>Jakarta, Indonesia 13530</li>
                    </ul>
                </div>
            </div>
            <div class="copy">&copy; 2026 Mooolagi. All rights reserved.</div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
