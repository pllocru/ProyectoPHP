<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Ejecuta la migración para crear la tabla clients.
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('cif')->unique(); // CIF único del cliente
            $table->string('name'); // Nombre del cliente
            $table->string('telefono')->unique(); // Teléfono único
            $table->string('email')->unique(); // Correo único
            $table->string('cuenta_corriente'); // Número de cuenta bancaria
            $table->unsignedBigInteger('pais_id')->nullable(); // Relación con la tabla de países
            $table->string('moneda'); // Moneda en la que paga el cliente
            $table->decimal('importe_cuota_mensual', 10, 2); // Importe de la cuota mensual
            $table->timestamps(); // Fechas de creación y actualización

            // Clave foránea a la tabla de países
            $table->foreign('pais_id')->references('id')->on('paises')->onDelete('set null');
        });
    }

    /**
     * Revierte la migración.
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
