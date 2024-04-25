<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalleexpedientedocumento extends Model
{
    use HasFactory;

    protected $table='detalle_expediente_documento';

    protected $primaryKey='ded_id';

    protected $fillable = [
        'ded_id',
        'ded_anio_eje',
        'ded_expediente',
        'ded_fase',
        'ded_secuencia',
        'ded_cod_doc',
        'ded_num_doc',
        'ded_fech_doc',
        'ded_nombre',
        'ded_monto',
        'expediente_documento_ed_id'
    ];
}
