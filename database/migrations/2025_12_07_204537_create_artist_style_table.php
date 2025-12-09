<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('artist_style', function (Blueprint $table) {
            $table->id();

            // ID del Artista
            $table->foreignId('artist_id')->constrained()->onDelete('cascade');

            // ID del Estilo
            $table->foreignId('style_id')->constrained()->onDelete('cascade');

            // Evitar duplicados (que no puedas asignar "Realismo" dos veces al mismo tío)
            $table->unique(['artist_id', 'style_id']);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_style');
    }
};
