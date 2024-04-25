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
        Schema::create('planillamcpp', function (Blueprint $table) {
            $table->bigIncrements('pm_id');
            $table->string('pm_anio');
            $table->string('pm_mes');
            $table->string('pm_tipoplanilla');
            $table->string('pm_claseplanilla');
            $table->char('pm_correlativo',4);
            $table->string('pm_ticket');
            $table->decimal('pm_montoneto',11,2);
            $table->string('pm_banco');
            $table->string('pm_cuenta');
            $table->integer('padron_personas_pp_id');
            $table->integer('expediente_documento_ed_id');
            $table->timestamps();

            $table->foreign('padron_personas_pp_id')
                ->references('pp_id')
                ->on('padron_personas')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('expediente_documento_ed_id')
                ->references('ed_id')
                ->on('expediente_documento')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planillamcpp');
    }
};
