<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupodescuentos extends Model
{
    use HasFactory;

    protected $table = 'grupos_descuentos';

    protected $primaryKey = 'gd_id';

    protected $fillable = [
        'gd_id','gd_grupo'
    ];
}
