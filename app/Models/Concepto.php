<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    use HasFactory;

    protected $table = 'conceptos';

    protected $primaryKey = 'con_id';

    protected $fillable = [
        'con_id', 'con_concepto','con_nombre','tipo_conceptos_tc_id','grupos_descuentos_gd_id'
    ];
}
