<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalleplanilla extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'detalle_planilla';

    protected $primaryKey='dp_id';

    protected $fillable = [
        'dp_id',
        'dp_cod_registro',
        'dp_cod_cargo',
        'situacion_personal_sp_id',
        'nec_nec_id',
        'nivel_n_id',
        'establecimiento_est_id',
        'dp_plaza',
        'pd_dias_lab',
        'dp_fech_ini',
        'dp_fech_term',
        'tipo_servidor_ts_id',
        'dp_nivel_mag',
        'dp_nivel_magref',
        'dp_categoria_rem',
        'dp_jor_lab',
        'cargo_car_id',
        'regimen_pension_rp_id',
        'dp_seg_salud',
        'dp_num_segsalud',
        'admin_pension_ap_id',
        'dp_cuspp',
        'dp_fech_afi',
        'dp_fech_dev',
        'dp_tip_encarg',
        'dp_tipo_plaza',
        'dp_dias_lic',
        'dp_fech_ini_lic',
        'dp_cuenta',
        'dp_leyenda_mensual',
        'dp_leyenda_permanente',
        'regimen_laboral_rl_id',
        'dp_horas_adicionales',
        'dp_cod_nexus',
        'dp_bruto',
        'dp_afecto',
        'dp_desc',
        'dp_liquido',
        'dp_essalud',
        'dp_noabono',
        'dp_motivo_na',
        'dp_usuario_na',
        'planilla_pll_id',
        'personal_p_id',
        'tipo_planilla_tp_id'
    ];

    public function res_conceptos()
    {
        return $this->hasMany('App\Models\Planillaconceptos', 'detalle_planilla_dp_id','dp_id')->join('conceptos', 'planilla_conceptos.conceptos_con_id', '=', 'conceptos.con_id');
    }

}
