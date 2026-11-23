<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use App\Models\Produk;
use App\Models\ProfilKontak;
use App\Models\Testimoni;
use Illuminate\View\View;

class PublicProfilController extends Controller
{
    /**
     * Menampilkan halaman Beranda dan Profil Studio / About Us (UC-01, KF-01).
     *
     * @return \Illuminate\View\View Halaman L-01 Beranda & Profil
     */
    public function index(): View
    {
        $profil = ProfilKontak::first();
        $produkUnggulan = Produk::with('kategori')->orderByDesc('id_produk')->take(3)->get();
        $totalProduk = Produk::count();
        $waLink = $profil ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $profil->nomor_wa) : '#';

        return view('publik.beranda', compact('profil', 'produkUnggulan', 'totalProduk', 'waLink'));
    }

    /**
     * Menampilkan galeri karya portofolio dan ulasan testimoni (UC-01, KF-02, KF-03).
     *
     * @return \Illuminate\View\View Halaman L-03 Portofolio & Testimoni
     */
    public function portofolio(): View
    {
        $portofolio = Portofolio::all();
        $testimoni = Testimoni::orderByDesc('tanggal')->get();

        return view('publik.portofolio', compact('portofolio', 'testimoni'));
    }

    /**
     * Menampilkan halaman Testimoni pelanggan (UC-01, KF-03).
     *
     * @return \Illuminate\View\View Halaman L-03 Testimoni
     */
    public function testimoni(): View
    {
        $testimoni = Testimoni::orderByDesc('tanggal')->get();

        return view('publik.testimoni', compact('testimoni'));
    }

    /**
     * Menampilkan halaman kontak dan tautan WhatsApp Admin (UC-01, KF-04).
     *
     * @return \Illuminate\View\View Halaman L-04 Kontak & Link WA
     */
    public function kontak(): View
    {
        $profil = ProfilKontak::first();
        $waLink = $profil ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $profil->nomor_wa) : '#';

        return view('publik.kontak', compact('profil', 'waLink'));
    }
}
