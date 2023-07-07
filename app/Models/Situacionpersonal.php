<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situacionpersonal extends Model
{
    use HasFactory;

    protected $table = 'situacion_personal';

    protected $primaryKey='sp_id';

    protected $fillable = [
        'sp_id','sp_situacion'
    ];
}
