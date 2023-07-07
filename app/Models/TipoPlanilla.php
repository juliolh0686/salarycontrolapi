<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPlanilla extends Model
{
    use HasFactory;

    protected $table = 'tipo_planilla';

    protected $primaryKey='tp_id';

    protected $fillable = [
        'tp_id','tp_descripcion'
    ];
}
