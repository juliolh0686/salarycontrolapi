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
        Schema::create('expediente_documento', function (Blueprint $table) {
            $table->bigIncrements('ed_id');
            $table->char('ed_anio_eje',6);
            $table->char('ed_expediente',10);
            $table->char('ed_secuencia',4);
            $table->char('ed_num_doc',20);
            $table->string('ed_descripcion',500);
            $table->integer('expediente_nota_en_id');
            $table->timestamps();

            $table->foreign('expediente_nota_en_id')
                ->references('en_id')
                ->on('expediente_nota')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expediente_documento');
    }
};
