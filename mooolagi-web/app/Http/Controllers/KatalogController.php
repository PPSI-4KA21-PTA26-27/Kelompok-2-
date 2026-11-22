<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KatalogController extends Controller
{
    /**
     * Menampilkan daftar katalog produk dengan filter kategori dan pencarian kata kunci
     * (UC-02, KF-05, KF-06).
     *
     * @param  \Illuminate\Http\Request  $request  Parameter opsional: kategori, search
     * @return \Illuminate\View\View               Halaman L-02 Katalog Produk
     */
    public function katalog(Request $request): View
    {
        $kategoriList = Kategori::all();
        $query = Produk::with('kategori');

        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        if ($request->filled('search')) {
            $keyword = trim($request->search);
            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                  ->orWhere('deskripsi', 'like', "%{$keyword}%");
            });
        }

        $produkList = $query->get();

        return view('publik.katalog', compact('produkList', 'kategoriList'));
    }

    /**
     * Menampilkan rincian detail satu produk berdasarkan ID (UC-02, KF-06).
     *
     * @param  int  $id  ID produk yang dipilih
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse Halaman detail, atau kembali ke katalog bila produk tidak ada
     */
    public function detail(int $id): View|RedirectResponse
    {
        $produk = Produk::with('kategori')->find($id);

        // Sesuai SDD UC-02 (alternatif 4a): produk tidak ada -> kembali ke katalog dengan pesan
        if (! $produk) {
            return redirect()->route('katalog')->with('error', 'Produk tidak tersedia.');
        }

        return view('publik.detail_produk', compact('produk'));
    }
}
