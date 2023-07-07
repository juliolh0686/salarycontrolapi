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
        Schema::create('secuencia_funcional', function (Blueprint $table) {
            $table->increments('sf_id');
            $table->char('sf_anio',4);
            $table->char('sf_secuencia_funcional',4);
            $table->string('sf_descripcion',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secuencia_funcional');
    }
};
