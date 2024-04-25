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
        Schema::create('padron_personas', function (Blueprint $table) {
            $table->bigIncrements('pp_id');
            $table->string('pp_tip_doc');
            $table->string('pp_num_doc',20);
            $table->string('pp_nombre',200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('padron_personas');
    }
};
