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
        Schema::create('capres_cawapres', function (Blueprint $table) {
            $table->id();
            $table->integer('pasangan');
            $table->string('partai');
            $table->tinyInteger('status_pemilu')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capres_cawapres');
    }
};
