<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expedientenota extends Model
{
    use HasFactory;

    protected $table='expediente_nota';

    protected $primaryKey='en_id';

    protected $fillable = [
        'en_id','en_anio_eje','en_expediente', 'en_fase','en_secuencia','en_secuencia_nota', 'en_nota','en_estado_envio'
    ];
}
