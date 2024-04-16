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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_diklat');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_promo')->nullable();
            $table->timestamp('waktu_pendaftaran');
            $table->integer('harga_diklat'); 
            $table->enum('status_pembayaran_diklat', ['Lunas', 'Belum dibayar', 'Dicek'])->default('Belum dibayar');
            $table->string('nama_depan')->nullable();
            $table->string('nama_belakang')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->enum('status_pembayaran_daftar', ['Lunas', 'Belum dibayar', 'Dicek'])->default('Belum dibayar');
            $table->longText('pesan_email')->nullable();
            $table->bigInteger('nominal_upload_diklat')->nullable();
            $table->bigInteger('nominal_upload_daftar')->nullable();
            $table->string('sertifikat')->nullable();
            $table->foreign('id_diklat')->references('id')->on('diklat')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('id_promo')->references('id')->on('promos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
