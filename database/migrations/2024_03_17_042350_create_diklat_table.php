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
            $table->bigInteger('harga');
            $table->integer('kuota_minimal');
            $table->integer('jumlah_pendaftar')->default(0);
            $table->enum('status', ['full', 'belum full']);
            $table->longText('deskripsi')->nullable();
            $table->longText('gambar')->charset('binary')->nullable();
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
