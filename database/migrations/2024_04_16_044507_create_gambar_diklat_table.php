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
        Schema::create('gambar_diklat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_diklat')->nullable();
            $table->text('gambar_navbar')->charset('binary');
            $table->foreign('id_diklat')->references('id')->on('diklat')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gambar_diklat');
    }
};
