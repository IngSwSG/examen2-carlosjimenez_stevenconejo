<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('idUsuario');
            $table->integer('identificacion');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('telefono');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};