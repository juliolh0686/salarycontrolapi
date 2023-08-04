<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipoconceptos extends Model
{
    use HasFactory;

    protected $table = 'tipo_conceptos';

    protected $primaryKey='tc_id';

    protected $fillable = [
        'tc_id','tc_tipo'
    ];
}
