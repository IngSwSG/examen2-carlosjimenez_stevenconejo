<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('material_unidades', function (Blueprint $table) {
            $table->id('idMaterialUnidad');
            $table->integer('cantidad');
            $table->unsignedBigInteger('idUnidad');
            $table->unsignedBigInteger('codigoPresupuesto');
            $table->unsignedBigInteger('codigoMaterial');
            $table->foreign('idUnidad')->references('idUnidad')->on('unidades');
            $table->foreign('codigoPresupuesto')->references('codigoPresupuesto')->on('presupuestos');
            $table->foreign('codigoMaterial')->references('codigo')->on('materiales');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_unidades');
    }
}; 