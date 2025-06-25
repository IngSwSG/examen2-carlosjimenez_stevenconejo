<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('material_unidads', function (Blueprint $table) {
            $table->id('idMaterialUnidad');
            $table->integer('cantidad');
            $table->unsignedBigInteger('idUnidad');
            $table->unsignedBigInteger('codigoPresupuesto');
            $table->foreign('idUnidad')->references('idUnidad')->on('unidads');
            $table->foreign('codigoPresupuesto')->references('codigoPresupuesto')->on('presupuestos');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_unidads');
    }
}; 