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
            $table->text('bukti_pembayaran')->charset('binary')->nullable();
            $table->bigInteger('harga_diklat')->nullable(); 
            $table->bigInteger('potongan')->nullable(); 
            $table->string('status_pembayaran_diklat')->default('Menunggu pembayaran')->nullable(); //nnti isi dropdon
            $table->string('nama_lengkap')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('jenis_pembayaran_diklat')->nullable(); //bayar pake qris/shopepay dll
            $table->string('updated_at_pembayaran_diklat')->nullable(); 
            $table->string('jenis_pembayaran_daftar')->nullable(); //bayar pake qris/shopepay dll
            $table->string('updated_at_pembayaran_daftar')->nullable();
            $table->string('status_pembayaran_daftar')->default('Menunggu pembayaran')->nullable(); //nnti isi dropdon
            $table->string('metode_sertif')->nullable();//nnti isi dropdon
            $table->longText('s_link')->nullable();
            $table->text('s_gambar')->charset('binary')->nullable();
            $table->text('s_doc')->charset('binary')->nullable();
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
