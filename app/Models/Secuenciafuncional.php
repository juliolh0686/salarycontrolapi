<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secuenciafuncional extends Model
{
    use HasFactory;

    protected $table = 'secuencia_funcional';

    protected $primaryKey='sf_id';

    protected $fillable = [
        'sf_id','sf_anio','sf_secuencia_funcional','sf_descripcion'
    ];
}
