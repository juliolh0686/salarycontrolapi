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
        Schema::create('expediente_nota', function (Blueprint $table) {
            $table->bigIncrements('en_id');
            $table->char('en_anio_eje',6);
            $table->char('en_expediente',10);
            $table->char('en_fase',1);
            $table->char('en_secuencia',4);
            $table->char('en_secuencia_nota',4);
            $table->string('en_nota',200);
            $table->char('en_estado_envio',1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expediente_nota');
    }
};
