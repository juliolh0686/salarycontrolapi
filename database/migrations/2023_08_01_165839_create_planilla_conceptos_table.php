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
        Schema::create('planilla_conceptos', function (Blueprint $table) {
            $table->increments('pcon_id');
            $table->decimal('pcon_monto',11,2);
            $table->integer('conceptos_con_id');
            $table->integer('clasificador_cl_id');
            $table->integer('secuencia_funcional_sf_id');
            $table->integer('detalle_planilla_dp_id');
            $table->boolean('pcon_noabono')->nullable();
            $table->integer('tipo_planilla_tp_id');
            $table->timestamps();

            //Relation
            $table->foreign('conceptos_con_id')->references('con_id')->on('conceptos');
            $table->foreign('clasificador_cl_id')->references('cl_id')->on('clasificador');
            $table->foreign('secuencia_funcional_sf_id')->references('sf_id')->on('secuencia_funcional');
            $table->foreign('detalle_planilla_dp_id')->references('dp_id')->on('detalle_planilla');
            $table->foreign('tipo_planilla_tp_id')->references('tp_id')->on('tipo_planilla');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planilla_conceptos');
    }
};
