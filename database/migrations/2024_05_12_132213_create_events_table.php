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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_diklat')->nullable();
            $table->string('title')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('category', ['primary', 'secondary', 'success', 'danger', 'warning', 'info']);
            $table->timestamps();
            $table->foreign('id_diklat')->references('id')->on('diklat')->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};