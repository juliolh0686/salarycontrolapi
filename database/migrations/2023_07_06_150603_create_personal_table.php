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
        Schema::create('personal', function (Blueprint $table) {
            $table->char('p_id', 10)->primary();
            $table->string('p_a_paterno',60);
            $table->string('p_a_materno',60);
            $table->string('p_nombres',60);
            $table->integer('sexo_p_sexo');
            $table->date('p_fech_nac');
            $table->integer('p_tip_doc');
            $table->string('p_num_doc',10);
            $table->integer('nacionalidad_n_id');
            $table->timestamps();

            //Relation
            $table->foreign('sexo_p_sexo')->references('s_id')->on('sexo');
            $table->foreign('p_tip_doc')->references('td_id')->on('tipo_documento');
            $table->foreign('nacionalidad_n_id')->references('n_id')->on('nacionalidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal');
    }
};
