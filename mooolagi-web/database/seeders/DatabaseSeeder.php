<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Data awal Sprint 1 — isi disesuaikan dengan mockup Figma System Designer.
 * Foto produk ada di public/images (path relatif terhadap folder public).
 */
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

        // Urutan kategori mengikuti tombol filter pada mockup Katalog
        $blind  = DB::table('kategori')->insertGetId(['nama_kategori' => 'Blind Box']);
        $canva  = DB::table('kategori')->insertGetId(['nama_kategori' => 'Canva Template']);
        $note   = DB::table('kategori')->insertGetId(['nama_kategori' => 'Digital Notepad']);
        $box    = DB::table('kategori')->insertGetId(['nama_kategori' => 'Custom Box']);
        $photo  = DB::table('kategori')->insertGetId(['nama_kategori' => 'Photostrip & Tracker']);

        // Dimasukkan dari yang paling lama ke terbaru agar urutan "Terbaru" sama dengan mockup
        DB::table('produk')->insert([
            ['id_kategori' => $canva, 'nama' => 'Custom Design Service - E-Invitation & Souvenir Mockup',
             'deskripsi' => 'Layanan desain custom 1-on-1 bersama tim desainer Mooolagi untuk kebutuhan undangan pernikahan, ulang tahun, atau packaging bisnis.',
             'harga' => 85000, 'gambar' => 'images/produk-desain.jpg'],
            ['id_kategori' => $photo, 'nama' => 'Photostrip Vintage 4-Cut & Study Tracker Set',
             'deskripsi' => 'Cetak foto strip ala Korea 4-pose dengan laminasi doff tahan air + bonus kalender tracker belajar mini estetik.',
             'harga' => 39000, 'gambar' => 'images/produk-photostrip.jpg'],
            ['id_kategori' => $box, 'nama' => 'Custom Hardbox Hampers Wisuda / Graduasi Eksklusif',
             'deskripsi' => 'Kotak kado premium bahan hardbox magnetik dengan foil emas custom nama penerima, pita satin, dan shredded paper estetik.',
             'harga' => 195000, 'gambar' => 'images/produk-hampers.jpg'],
            ['id_kategori' => $note, 'nama' => 'Digital Notepad & Cute Daily Planner (GoodNotes/Notability)',
             'deskripsi' => 'Planner digital interaktif dengan hyperlink bulanan, mood tracker harian, dan bonus 200+ stiker digital format PNG transparan.',
             'harga' => 55000, 'gambar' => 'images/produk-notepad.jpg'],
            ['id_kategori' => $canva, 'nama' => 'Canva Template Bundle - Aesthetic Love & Anniversary',
             'deskripsi' => '35+ template Canva siap pakai untuk scrapbook digital, feed Instagram kado, dan e-card interaktif yang bisa diklik.',
             'harga' => 49000, 'gambar' => 'images/produk-canva.jpg'],
            ['id_kategori' => $blind, 'nama' => 'Custom Mystery Blind Box - Birthday Edition',
             'deskripsi' => 'Kado misteri penuh kejutan berisi 4-6 item personal custom: photo strip, akrilik keychain, mini surat rahasia, dan snack pilihan.',
             'harga' => 135000, 'gambar' => 'images/produk-blindbox.jpg'],
        ]);

        DB::table('portofolio')->insert([
            ['id_admin' => $adminId, 'judul' => 'Pastel Birthday Blind Box — Project Karin & Friends',
             'deskripsi' => 'Blind box bertema pastel lilac dengan 5 kejutan mini untuk ulang tahun ke-21 yang mengutamakan unboxing experience berkesan.',
             'gambar' => 'images/produk-blindbox.jpg'],
            ['id_admin' => $adminId, 'judul' => 'Corporate Year-End Hampers — Glow Creative Studio',
             'deskripsi' => '50 paket hampers akhir tahun dengan printed hardcover box, tumbler grafir laser, dan custom digital planner 2025.',
             'gambar' => 'images/produk-hampers.jpg'],
            ['id_admin' => $adminId, 'judul' => 'Wedding Digital Canva Stationery — Raka & Dhea',
             'deskripsi' => 'Desain identitas pernikahan lengkap: e-invitation interaktif, photobooth frame, dan photostrip souvenir untuk 300 tamu.',
             'gambar' => 'images/produk-desain.jpg'],
            ['id_admin' => $adminId, 'judul' => 'Korean Photostrip & Habit Tracker — Study With Nadira',
             'deskripsi' => 'Seri photostrip bernuansa Y2K retro untuk merchandise komunitas belajar online, dicetak di atas kertas foto doff premium.',
             'gambar' => 'images/produk-photostrip.jpg'],
        ]);

        DB::table('testimoni')->insert([
            ['id_admin' => $adminId, 'nama_pemberi' => 'Nadia Putri', 'tanggal' => '2026-11-02',
             'isi_testimoni' => 'Blind box-nya personal banget! Detail pita segel lilin dan surat rahasianya bikin sahabatku terharu sampai nangis pas buka. Packaging-nya luar biasa rapi dan kokoh.'],
            ['id_admin' => $adminId, 'nama_pemberi' => 'Raka & Dhea', 'tanggal' => '2026-10-28',
             'isi_testimoni' => 'Template Canva-nya gampang banget diedit di HP maupun laptop. Font dan palet warnanya super estetik. Kami bikin video scrapbook digital dalam waktu kurang dari 1 jam!'],
            ['id_admin' => $adminId, 'nama_pemberi' => 'Glow Creative Studio', 'tanggal' => '2026-10-20',
             'isi_testimoni' => 'Pesanan corporate hampers selesai tepat waktu. Foil emas nama pada box sangat rapi dan presisi. Komunikasi admin via WhatsApp sangat komunikatif dan informatif.'],
        ]);

        DB::table('profil_kontak')->insert([
            'id_admin'    => $adminId,
            'teks_profil' => 'Mooolagi adalah Creative Gift & Design Studio yang percaya bahwa setiap hadiah punya cerita untuk disampaikan. Kami hadir untuk membantu kamu mewujudkan kejutan yang personal dan penuh makna, mulai dari Canva template, digital notepad, custom box, hingga kreasi custom blind box yang penuh kejutan.',
            'nomor_wa'    => '6289603961169',
            'kontak_lain' => 'helpdesk@mooolagi.my.id',
        ]);
    }
}
