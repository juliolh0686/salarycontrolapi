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
        Schema::create('detalle_expediente_documento', function (Blueprint $table) {
            $table->bigIncrements('ded_id');
            $table->char('ded_anio_eje',6);
            $table->char('ded_expediente',10);
            $table->char('ded_fase',1);
            $table->char('ded_secuencia',4);
            $table->char('ded_cod_doc',3);
            $table->char('ded_num_doc',20);
            $table->date('ded_fech_doc');
            $table->string('ded_nombre',200);
            $table->decimal('ded_monto',11,2);
            $table->integer('expediente_documento_ed_id');
            $table->timestamps();

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
        Schema::dropIfExists('detalle_expediente_documento');
    }
};
