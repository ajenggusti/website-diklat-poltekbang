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
        Schema::create('diklat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kategori_diklat');
            $table->string('nama_diklat');
            $table->decimal('harga');
            $table->integer('kuota_minimal');
            $table->integer('jumlah_pendaftar');
            $table->enum('status', ['full', 'belum full']);
            $table->string('durasi');
            $table->longText('deskripsi');
            $table->longText('tujuan');
            $table->longText('topik');
            $table->longText('tipe');
            $table->longText('metode');
            $table->longText('fasilitas');
            $table->longText('persyaratan');
            $table->longText('lokasi');
            $table->longText('gambar')->charset('binary');
            $table->foreign('id_kategori_diklat')->references('id')->on('kategori_diklat')->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diklat');
    }
};
