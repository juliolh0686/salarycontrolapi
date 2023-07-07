<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadoplanilla extends Model
{
    use HasFactory;

    protected $table = 'estado_planilla';

    protected $primaryKey='ep_id';

    protected $fillable = [
      'ep_id',
      'ep_estado'
    ];

}
