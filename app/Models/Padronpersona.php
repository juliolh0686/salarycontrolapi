<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Padronpersona extends Model
{
    use HasFactory;

    protected $table = 'padron_personas';

    protected $primaryKey = 'pp_id';

    protected $fillable = [
        'pp_id',
        'pp_tip_doc',
        'pp_num_doc',
        'pp_nombre',
    ];
}
