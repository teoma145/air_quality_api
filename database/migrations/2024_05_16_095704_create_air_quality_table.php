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
        Schema::create('air_quality', function (Blueprint $table) {
            $table->id();
            $table->string('data_di_misurazione')->nullable();
            $table->unsignedBigInteger('id_station')->nullable();
            $table->string('denominazione');
            $table->string('comune');
            $table->string('provincia');
            $table->double('latitudine')->nullable();
            $table->double('longitudine')->nullable();
            $table->string('tipologia_di_area')->nullable();
            $table->string('tipologia_stazione')->nullable();
            $table->enum('interesse_rete', ['pubblico', 'privato'])->default('pubblico');
            $table->string('inquinante_misurato')->nullable();
            $table->double('valore_inquinante_misurato');
            $table->double('limite')->nullable();
            $table->string('unita_di_misura')->nullable();
            $table->unsignedBigInteger('superamenti')->nullable();
            $table->unsignedBigInteger('indice_qualita')->nullable();
            $table->string('classe_qualità')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('air_quality');
    }
};
