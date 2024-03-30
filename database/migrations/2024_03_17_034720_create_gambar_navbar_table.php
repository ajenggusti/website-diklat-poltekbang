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
        Schema::create('gambar_navbar', function (Blueprint $table) {
            $table->id('id')->autoIncrement();
            $table->text('gambar_navbar')->charset('binary'); // BLOB
            $table->enum('status', ['tampilkan', 'sembunyikan'])->default('sembunyikan');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gambar_navbar');
    }
};
