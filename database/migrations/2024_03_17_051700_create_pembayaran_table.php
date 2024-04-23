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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->unsignedBigInteger('id_pendaftaran');
            $table->enum('jenis_pembayaran', ['diklat', 'pendaftaran']);
            $table->string('metode_pembayaran');
            $table->bigInteger('total_harga');
            $table->timestamps();
            $table->foreign('id_pendaftaran')->references('id')->on('pendaftaran')->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
