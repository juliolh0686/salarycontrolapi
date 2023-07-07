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
            $table->integer('nivel_n_id');
            $table->char('establecimiento_est_id',8);
            $table->char('dp_plaza',4);
            $table->integer('pd_dias_lab');
            $table->date('dp_fech_ini');
            $table->date('dp_fech_term');
            $table->integer('tipo_servidor_ts_id');
            $table->char('dp_nivel_mag',2);
            $table->char('dp_nivel_magref',2);
            $table->char('dp_categoria_rem',2);
            $table->integer('dp_jor_lab');
            $table->char('cargo_car_id',4);
            $table->integer('regimen_pension_rp_id');
            $table->integer('p_seg_salud');
            $table->string('dp_num_segsalud',20);
            $table->integer('admin_pension_ap_id');
            $table->char('dp_cuspp',20);
            $table->date('dp_fech_afi');
            $table->date('dp_fech_dev');
            $table->integer('dp_tip_encarg');
            $table->char('dp_tipo_plaza',2);
            $table->integer('dp_dias_lic');
            $table->date('dp_fech_ini_lic');
            $table->char('dp_cuenta',11);
            $table->string('dp_leyenda_mensual',100);
            $table->string('dp_leyenda_permanente',100);
            $table->integer('regimen_laboral_rl_id');
            $table->integer('dp_horas_adicionales');
            $table->char('cod_nexus',12);
            $table->decimal('dp_bruto',11,2);
            $table->decimal('dp_afecto',11,2);
            $table->decimal('dp_desc',11,2);
            $table->decimal('dp_liquido',11,2);
            $table->decimal('dp_essalud',11,2);
            $table->boolean('dp_noabono');
            $table->string('dp_motivo_na',200);
            $table->string('dp_usuario_na',50);
            $table->integer('planilla_pll_id');
            $table->char('personal_p_id',10);
            $table->integer('tipo_planilla_tp_id');
            $table->timestamps();
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
