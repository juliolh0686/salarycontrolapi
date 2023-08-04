<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planillaconceptos extends Model
{
    use HasFactory;

    protected $table = 'planilla_conceptos';

    protected $primaryKey = 'pcon_id';

    protected $fillable = [
        'pcon_id','pcon_monto','conceptos_con_id','clasificador_cl_id','secuencia_funcional_sf_id','detalle_planilla_dp_id','pcon_noabono','tipo_planilla_tp_id'
    ];
}
