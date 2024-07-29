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
        Schema::create('pemilu_presidens', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('provinsi_domisili');
            $table->string('kota_domisili');
            $table->unsignedBigInteger('pilihan');
            $table->foreign('pilihan')->references('pasangan')->on('capres_cawapres');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemilu_presidens');
    }
};
