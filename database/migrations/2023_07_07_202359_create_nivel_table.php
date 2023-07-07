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
        Schema::create('nivel', function (Blueprint $table) {
            $table->char('n_id',2)->primary();
            $table->string('n_nivel',40);
            $table->integer('sec_cod_sec_fun');
            $table->timestamps();

            //Relation
            $table->foreign('sec_cod_sec_fun')->references('sf_id')->on('secuencia_funcional');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nivel');
    }
};
