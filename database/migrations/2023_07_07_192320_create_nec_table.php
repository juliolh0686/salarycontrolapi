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
        Schema::create('nec', function (Blueprint $table) {
            $table->char('nec_id',2)->primary();
            $table->string('nec_nec',10);
            $table->string('nec_distrito');
            $table->string('nec_espe_responsable',40);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nec');
    }
};
