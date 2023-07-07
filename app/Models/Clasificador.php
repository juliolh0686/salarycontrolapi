<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clasificador extends Model
{
    use HasFactory;

    protected $table = 'clasificador';

    protected $primaryKey='cl_id';

    protected $fillable = [
      'cl_id',
      'cl_clasificador',
      'cl_descripcion'
    ];
}
