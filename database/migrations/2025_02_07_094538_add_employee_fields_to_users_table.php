<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Ejecuta la migración.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('dni')->unique()->after('id');
            $table->string('phone')->after('email');
            $table->string('address')->after('phone');
            $table->date('hire_date')->nullable()->after('address');
        });
    }

    /**
     * Revierte la migración.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['dni', 'phone', 'address', 'hire_date']);
        });
    }
};

