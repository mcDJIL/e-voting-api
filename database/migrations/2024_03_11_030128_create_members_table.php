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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->date('tanggal_lahir')->nullable();
            $table->string('provinsi_domisili')->nullable();
            $table->string('kota_domisili')->nullable();
            $table->unsignedBigInteger('id_provinsi');
            $table->unsignedBigInteger('id_kota');
            $table->foreign('id_provinsi')->references('id')->on('provinsies');
            $table->foreign('id_kota')->references('id')->on('kotas');
            $table->string('token')->nullable();
            $table->tinyInteger('isBan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
