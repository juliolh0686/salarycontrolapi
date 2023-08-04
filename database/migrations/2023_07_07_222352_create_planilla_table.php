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
        Schema::create('planilla', function (Blueprint $table) {
            $table->increments('pll_id');
            $table->char('pll_periodo',6);
            $table->decimal('pll_bruto',11,2)->nullable();
            $table->decimal('pll_desc',11,2)->nullable();
            $table->decimal('pll_liquido',11,2)->nullable();
            $table->decimal('pll_essalud',11,2)->nullable();
            $table->string('pll_descripcion',100)->nullable();
            $table->integer('estado_planilla_ep_id');
            $table->timestamps();

            //Relation
            $table->foreign('estado_planilla_ep_id')->references('ep_id')->on('estado_planilla');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planilla');
    }
};
