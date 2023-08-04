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
        Schema::create('conceptos', function (Blueprint $table) {
            $table->increments('con_id');
            $table->string('con_concepto',6);
            $table->string('con_nombre',45);
            $table->integer('tipo_conceptos_tc_id');
            $table->integer('grupos_descuentos_gd_id');
            $table->timestamps();

            $table->foreign('tipo_conceptos_tc_id')->references('tc_id')->on('tipo_conceptos');
            $table->foreign('grupos_descuentos_gd_id')->references('gd_id')->on('grupos_descuentos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conceptos');
    }
};
