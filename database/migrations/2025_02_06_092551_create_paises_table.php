<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Ejecuta la migración para crear la tabla paises.
     */
    public function up()
    {
        Schema::create('paises', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique(); // Nombre del país
            $table->string('codigo')->unique(); // Código ISO del país
            $table->string('moneda')->nullable(); // Moneda del país
            $table->timestamps(); // Fechas de creación y actualización
        });
    }

    /**
     * Revierte la migración.
     */
    public function down()
    {
        Schema::dropIfExists('paises');
    }
};

