<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = DB::table('admin')->insertGetId([
            'nama'       => 'Nalla Herbaria',
            'email'      => 'admin@mooolagi.id',
            'kata_sandi' => Hash::make('admin12345'),
        ]);

        DB::table('akun_pelanggan')->insert([
            'username_nama'  => 'Nadia Putri',
            'email'          => 'pelanggan@mooolagi.id',
            'kata_sandi'     => Hash::make('pelanggan123'),
            'tanggal_daftar' => now(),
        ]);

        $katCanva  = DB::table('kategori')->insertGetId(['nama_kategori' => 'Canva Template']);
        $katCustom = DB::table('kategori')->insertGetId(['nama_kategori' => 'Custom Desain']);
        $katPhoto  = DB::table('kategori')->insertGetId(['nama_kategori' => 'Photostrip']);

        DB::table('produk')->insert([
            [
                'id_kategori' => $katCanva,
                'nama'        => 'Canva Template Social Media Kit',
                'deskripsi'   => 'Paket 30 template feed & story Instagram siap edit di Canva.',
                'harga'       => 49000,
                'gambar'      => 'https://placehold.co/600x400/ede9fe/4c1d95?text=Canva+Template',
            ],
            [
                'id_kategori' => $katCustom,
                'nama'        => 'Custom Mystery Blind Box - Birthday Edition',
                'deskripsi'   => 'Desain kado kustom tema ulang tahun dikirim dalam format digital HD.',
                'harga'       => 129000,
                'gambar'      => 'https://placehold.co/600x400/fce7f3/831843?text=Custom+Desain',
            ],
            [
                'id_kategori' => $katPhoto,
                'nama'        => 'Photostrip Vintage 4-Cut & Study Tracker Set',
                'deskripsi'   => 'Template photostrip estetik 4-cut siap cetak dan format digital.',
                'harga'       => 35000,
                'gambar'      => 'https://placehold.co/600x400/e0f2fe/0c4a6e?text=Photostrip',
            ],
            [
                'id_kategori' => $katCanva,
                'nama'        => 'Presentation Deck Estetik UMKM',
                'deskripsi'   => '25 slide presentasi bisnis dan pitch deck kreatif siap pakai.',
                'harga'       => 59000,
                'gambar'      => 'https://placehold.co/600x400/fef3c7/78350f?text=Pitch+Deck',
            ],
        ]);

        DB::table('portofolio')->insert([
            [
                'id_admin'  => $adminId,
                'judul'     => 'Branding Kit UMKM Kopi Senja',
                'deskripsi' => 'Desain feed Instagram, kemasan cup, dan katalog menu digital.',
                'gambar'    => 'https://placehold.co/600x400/f3e8ff/581c87?text=Karya+Kopi+Senja',
            ],
            [
                'id_admin'  => $adminId,
                'judul'     => 'Birthday Gift Box Ilustrasi Personal',
                'deskripsi' => 'Ilustrasi karakter kustom dan kartu ucapan digital.',
                'gambar'    => 'https://placehold.co/600x400/dcfce7/14532d?text=Karya+Ilustrasi',
            ],
            [
                'id_admin'  => $adminId,
                'judul'     => 'Photostrip Event Wisuda 2026',
                'deskripsi' => 'Desain frame photobooth 4-cut bertema retro pastel.',
                'gambar'    => 'https://placehold.co/600x400/ffedd5/7c2d12?text=Karya+Photostrip',
            ],
        ]);

        DB::table('testimoni')->insert([
            [
                'id_admin'      => $adminId,
                'nama_pemberi'  => 'Raka Pratama',
                'isi_testimoni' => 'Hasil desainnya estetik, pengerjaan cepat, dan sangat komunikatif!',
                'tanggal'       => '2026-11-10',
            ],
            [
                'id_admin'      => $adminId,
                'nama_pemberi'  => 'Siti Rahma',
                'isi_testimoni' => 'Template Canva-nya gampang banget diedit untuk jualan online saya.',
                'tanggal'       => '2026-11-14',
            ],
        ]);

        DB::table('profil_kontak')->insert([
            'id_admin'    => $adminId,
            'teks_profil' => 'Mooolagi Creative Studio adalah studio desain kreatif yang membantu mewujudkan kado personal, Canva template, photostrip, dan kebutuhan desain digital yang berkesan untuk setiap momen spesialmu.',
            'nomor_wa'    => '6281234567890',
            'kontak_lain' => 'Instagram: @mooolagi.studio | Email: halo@mooolagi.id',
        ]);
    }
}
