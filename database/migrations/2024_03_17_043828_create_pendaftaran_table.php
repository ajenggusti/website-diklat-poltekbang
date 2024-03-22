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
            $table->unsignedBigInteger('id_promo');
            $table->timestamp('waktu_pendaftaran');
            $table->decimal('harga_diklat'); //apabila user ada promo, maka akan terpotong, dan masuk ke kolom ini. jika tidak ada, harga asli diklat yang masuk sini.
            $table->enum('status_pembayaran_diklat', ['Lunas', 'Belum dibayar', 'Dicek']);
            $table->string('nama_depan');
            $table->string('nama_belakang');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('pendidikan_terakhir');
            $table->string('email');
            $table->string('no_hp');
            $table->enum('status_pembayaran_daftar', ['Lunas', 'Belum dibayar', 'Dicek']);
            $table->string('sertifikat');
            $table->foreign('id_diklat')->references('id')->on('diklat')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('id_promo')->references('id')->on('promo')->onUpdate('cascade')
            ->onDelete('cascade');
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
