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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_level');
            $table->unsignedBigInteger('id_provinsi')->nullable();
            $table->unsignedBigInteger('id_kabupaten')->nullable();
            $table->unsignedBigInteger('id_kecamatan')->nullable();
            $table->unsignedBigInteger('id_kelurahan')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->unique();
            $table->text('berkas_pendukung')->charset('binary')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('nik')->nullable();
            $table->string('alamat')->nullable();
            $table->enum('jenis_berkas', ['ktp', 'paspor'])->nullable();
            $table->string('no_paspor')->nullable();
            $table->string('nationality')->nullable();
            $table->date('tgl_exp_paspor')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->enum('status', ['Belum diverifikasi', 'Sedang diverifikasi', 'Diverifikasi', 'Perlu pembaharuan'])->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('id_level')->references('id')->on('level')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_kelurahan')->references('id')->on('kelurahans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('id_kabupaten')->references('id')->on('kabupatens')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('id_kecamatan')->references('id')->on('kecamatans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('id_provinsi')->references('id')->on('provinsis')->cascadeOnUpdate()->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
