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
        Schema::create('testimoni', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_diklat');
            $table->unsignedBigInteger('id_pendaftaran');
            $table->string('profesi');
            $table->longText('testimoni');
            $table->foreign('id_pendaftaran')->references('id')->on('pendaftaran')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('id_diklat')->references('id')->on('diklat')->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimoni');
    }
};
