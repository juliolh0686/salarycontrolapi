<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    use HasFactory;

    protected $table = 'planilla';

    protected $primaryKey='pll_id';

    protected $fillable = [
        'pll_id',
        'pll_periodo',
        'pll_bruto',
        'pll_desc',
        'pll_liquido',
        'pll_essalud',
        'pll_descripcion',
        'estado_planilla_ep_id'
    ];
}
