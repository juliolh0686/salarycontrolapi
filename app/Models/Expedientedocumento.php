<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expedientedocumento extends Model
{
    use HasFactory;

    protected $table='expediente_documento';

    protected $primaryKey='ed_id';

    protected $fillable = [
        'ed_id',
        'ed_anio_eje',
        'ed_expediente',
        'ed_secuencia',
        'ed_num_doc',
        'ed_descripcion',
        'expediente_nota_en_id'
    ];

}
