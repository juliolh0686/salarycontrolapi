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
        Schema::create('detalle_planilla', function (Blueprint $table) {
            $table->increments('dp_id');
            $table->char('dp_cod_registro',16);
            $table->char('dp_cod_cargo',6);
            $table->integer('situacion_personal_sp_id');
            $table->char('nec_nec_id',2);
            $table->char('nivel_n_id',2);
            $table->char('establecimiento_est_id',8);
            $table->char('dp_plaza',4)->nullable();
            $table->integer('pd_dias_lab')->nullable();
            $table->date('dp_fech_ini')->nullable();
            $table->date('dp_fech_term')->nullable();
            $table->integer('tipo_servidor_ts_id');
            $table->char('dp_nivel_mag',2)->nullable();
            $table->char('dp_nivel_magref',2)->nullable();
            $table->char('dp_categoria_rem',2)->nullable();
            $table->integer('dp_jor_lab')->nullable();
            $table->char('cargo_car_id',4);
            $table->integer('regimen_pension_rp_id');
            $table->integer('dp_seg_salud')->nullable();
            $table->string('dp_num_segsalud',20)->nullable();
            $table->integer('admin_pension_ap_id');
            $table->char('dp_cuspp',20)->nullable();
            $table->date('dp_fech_afi')->nullable();
            $table->date('dp_fech_dev')->nullable();
            $table->integer('dp_tip_encarg')->nullable();
            $table->char('dp_tipo_plaza',2)->nullable();
            $table->integer('dp_dias_lic')->nullable();
            $table->date('dp_fech_ini_lic')->nullable();
            $table->char('dp_cuenta',11)->nullable();
            $table->string('dp_leyenda_mensual',100)->nullable();
            $table->string('dp_leyenda_permanente',100)->nullable();
            $table->integer('regimen_laboral_rl_id');
            $table->integer('dp_horas_adicionales')->nullable();
            $table->char('dp_cod_nexus',12)->nullable();
            $table->decimal('dp_bruto',11,2);
            $table->decimal('dp_afecto',11,2);
            $table->decimal('dp_desc',11,2);
            $table->decimal('dp_liquido',11,2);
            $table->decimal('dp_essalud',11,2);
            $table->boolean('dp_noabono');
            $table->string('dp_motivo_na',200)->nullable();
            $table->string('dp_usuario_na',50)->nullable();
            $table->integer('planilla_pll_id');
            $table->char('personal_p_id',10);
            $table->integer('tipo_planilla_tp_id');
            $table->timestamps();

            $table->foreign('situacion_personal_sp_id')->references('sp_id')->on('situacion_personal');
            $table->foreign('nec_nec_id')->references('nec_id')->on('nec');
            $table->foreign('nivel_n_id')->references('n_id')->on('nivel');
            $table->foreign('establecimiento_est_id')->references('est_id')->on('establecimiento');
            $table->foreign('tipo_servidor_ts_id')->references('ts_id')->on('tipo_servidor');
            $table->foreign('cargo_car_id')->references('car_id')->on('cargo');
            $table->foreign('regimen_pension_rp_id')->references('rp_id')->on('regimen_pension');
            $table->foreign('admin_pension_ap_id')->references('ap_id')->on('admin_pension');
            $table->foreign('regimen_laboral_rl_id')->references('rl_id')->on('regimen_laboral');
            $table->foreign('planilla_pll_id')->references('pll_id')->on('planilla');
            $table->foreign('personal_p_id')->references('p_id')->on('personal');
            $table->foreign('tipo_planilla_tp_id')->references('tp_id')->on('tipo_planilla');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_planilla');
    }
};
