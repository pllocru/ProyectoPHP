<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo'); // Título de la tarea/incidencia
            $table->text('descripcion')->nullable(); // Descripción detallada
            $table->enum('estado', ['pendiente', 'en_progreso', 'completada', 'cancelada'])->default('pendiente');
            $table->unsignedBigInteger('user_id'); // Usuario que creó la tarea
            $table->unsignedBigInteger('cliente_id')->nullable(); // Cliente relacionado con la tarea
            $table->unsignedBigInteger('asignado_a')->nullable(); // Usuario asignado a la tarea
            $table->text('anotaciones')->nullable(); // Notas al completar la tarea
            $table->timestamps();
            
            // Relaciones
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('set null');
            $table->foreign('asignado_a')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tareas');
    }
};