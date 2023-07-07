<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiposervidor extends Model
{
    use HasFactory;

    protected $table = 'tipo_servidor';

    protected $primaryKey='ts_id';

    protected $fillable = [
        'ts_id','ts_tipo_servidor','clasificador_cl_id'
    ];
}
