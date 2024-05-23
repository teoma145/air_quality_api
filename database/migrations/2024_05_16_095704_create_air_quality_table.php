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
            $table->date('data_di_misurazione')->nullable();
            $table->string('id_station')->nullable();
            $table->string('denominazione');
            $table->string('comune');
            $table->string('provincia');
            $table->double('longitudine');
            $table->double('latitudine')->nullable();
            $table->string('tipologia_di_area')->nullable();
            $table->string('tipologia_stazione')->nullable();
            $table->string('rete')->nullable();
            $table->string('interesse_rete')->nullable();
            $table->string('inquinante_misurato')->nullable();
            $table->float('valore_inquinante_misurato');
            $table->double('limite')->nullable();
            $table->string('unita_di_misura')->nullable();
            $table->unsignedBigInteger('superamenti')->nullable();
            $table->integer('indice_qualita')->nullable();
            $table->string('classe_qualità')->nullable();

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
