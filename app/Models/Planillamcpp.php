<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planillamcpp extends Model
{
    use HasFactory;

    protected $table = 'planillamcpp';

    protected $primaryKey = 'pm_id';

    protected $fillable = [
        'pm_id',
        'pm_anio',
        'pm_mes',
        'pm_tipoplanilla',
        'pm_claseplanilla',
        'pm_correlativo',
        'pm_ticket',
        'pm_montoneto',
        'pm_banco',
        'pm_cuenta',
        'padron_personas_pp_id',
        'expediente_documento_ed_id'
    ];

    public function detalledoc()
    {
        return $this->hasMany('App\Models\Detalleexpedientedocumento', 'expediente_documento_ed_id','expediente_documento_ed_id');
    }

}
