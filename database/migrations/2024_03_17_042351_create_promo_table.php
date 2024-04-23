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
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_diklat')->nullable();
            $table->text('gambar')->charset('binary');
            $table->bigInteger('potongan')->nullable();
            $table->string('kode')->unique();
            $table->string('tampil')->nullable();
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            $table->integer('kuota')->default(0);
            $table->enum('pakai_kuota', ['iya', 'tidak'])->default('tidak');
            $table->foreign('id_diklat')->references('id')->on('diklat')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
