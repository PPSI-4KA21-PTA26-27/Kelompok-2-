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
        Schema::create('profil_kontak', function (Blueprint $table) {
            $table->tinyIncrements('id_profil');
            $table->unsignedTinyInteger('id_admin');
            $table->text('teks_profil');
            $table->string('nomor_wa', 15);
            $table->string('kontak_lain', 100)->nullable();

            $table->foreign('id_admin')->references('id_admin')->on('admin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_kontak');
    }
};
