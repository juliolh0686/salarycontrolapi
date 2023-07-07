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
        Schema::create('tipo_servidor', function (Blueprint $table) {
            $table->integer('ts_id')->primary();
            $table->string('ts_tipo_servidor',45);
            $table->integer('clasificador_cl_id');
            $table->timestamps();

            //Relation
            $table->foreign('clasificador_cl_id')->references('cl_id')->on('clasificador');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_servidor');
    }
};
