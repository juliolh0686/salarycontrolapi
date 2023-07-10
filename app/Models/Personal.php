<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    protected $table = 'personal';

    protected $primaryKey='p_id';

    protected $fillable = [
      'p_id',
      'p_a_paterno',
      'p_a_materno',
      'p_nombres',
      'sexo_p_sexo',
      'p_fech_nac',
      'p_tip_doc',
      'p_num_doc',
      'nacionalidad_n_id'
    ];
}
