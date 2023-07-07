<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipodocumento extends Model
{
    use HasFactory;

    protected $table = 'tipo_documento';

    protected $primaryKey='td_id';

    protected $fillable = [
        'td_id','td_tipo_documento'
    ];

}
