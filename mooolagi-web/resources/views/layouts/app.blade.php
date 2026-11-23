<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mooolagi Creative Studio')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/mooolagi.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
@php
    // Data kontak untuk footer (tabel profil_kontak); nilai bawaan dipakai bila belum ada data
    $kontakFooter = \App\Models\ProfilKontak::first();
    $waDigit = preg_replace('/\D/', '', $kontakFooter->nomor_wa ?? '6289603961169');
    $waTampil = str_starts_with($waDigit, '62')
        ? '(+62) ' . substr($waDigit, 2, 3) . '-' . substr($waDigit, 5, 4) . '-' . substr($waDigit, 9)
        : $waDigit;
    $emailFooter = $kontakFooter->kontak_lain ?? 'helpdesk@mooolagi.my.id';
@endphp
    <nav class="navbar navbar-expand-lg mo-nav">
        <div class="container">
            <a class="mo-brand" href="{{ route('beranda') }}">mooolagi.</a>
            <span class="mo-tag d-none d-xl-inline">Creative Gift Studio</span>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-label="Menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <div class="mo-menu mx-auto d-flex flex-column flex-lg-row gap-1 py-2 py-lg-0">
                    <a href="{{ route('katalog') }}" class="{{ request()->routeIs('katalog', 'produk.detail') ? 'active' : '' }}">Katalog</a>
                    <a href="{{ route('portofolio') }}" class="{{ request()->routeIs('portofolio') ? 'active' : '' }}">Portfolio</a>
                    <a href="{{ route('testimoni') }}" class="{{ request()->routeIs('testimoni') ? 'active' : '' }}">Testimoni</a>
                    <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
                </div>
                <div class="d-flex align-items-center gap-3">
                    @if(Auth::guard('pelanggan')->check())
                        <span class="small fw-semibold">Halo, {{ Auth::guard('pelanggan')->user()->username_nama }}</span>
                        <form action="{{ route('pelanggan.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="mo-daftar" type="submit">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="mo-login">Masuk</a>
                        <a href="{{ route('register') }}" class="mo-daftar">Daftar</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

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

    <footer class="mo-footer mt-auto">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <span class="logo">mooolagi.</span>
                    <p class="mb-2">Creative Gift &amp; Design Studio — Jakarta, Indonesia.</p>
                    <p class="small mb-0">Spesialis kado personal, Canva template, custom box &amp; photostrip.</p>
                </div>
                <div class="col-lg-4">
                    <h6>Layanan Utama</h6>
                    <ul>
                        <li><a href="{{ route('katalog') }}">Canva Template Bundle</a></li>
                        <li><a href="{{ route('katalog') }}">Custom Photostrip &amp; Study Tracker</a></li>
                        <li><a href="{{ route('katalog') }}">Custom Mystery Blind Box</a></li>
                        <li><a href="{{ route('katalog') }}">Digital Notepad &amp; Planner</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h6>Kontak Resmi</h6>
                    <div>WhatsApp: {{ $waTampil }}</div>
                    <div>Email: {{ $emailFooter }}</div>
                    <div>Lokasi: Jakarta, Indonesia 13530</div>
                    <a class="admin-link" href="{{ route('admin.login') }}">Link: Portal Admin [Login]</a>
                </div>
            </div>
            <div class="copy">&copy; 2026 Mooolagi Creative Studio · Kelompok 2 4KA21</div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
