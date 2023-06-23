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
            $table->char('p_cod_mod ', 10)->primary();
            $table->string('p_a_paterno',60);
            $table->string('p_a_materno',60);
            $table->string('p_nombres',60);
            $table->char('p_sexo',1);
            $table->date('p_fech_nac');
            $table->char('p_tip_doc',1);
            $table->string('p_num_doc',10);
            $table->timestamps();
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
