<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;

    protected $table = 'nivel';

    protected $primaryKey='n_id';

    protected $fillable = [
      'n_id',
      'n_nivel',
      'sec_cod_sec_fun',
    ];
}
