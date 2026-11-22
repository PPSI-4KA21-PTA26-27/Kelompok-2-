<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('akun_pelanggan', function (Blueprint $table) {
            $table->increments('id_pelanggan');
            $table->string('username_nama', 50);
            $table->string('email', 80)->unique();
            $table->char('kata_sandi', 60);
            $table->dateTime('tanggal_daftar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun_pelanggan');
    }
};
