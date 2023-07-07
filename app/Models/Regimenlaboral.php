<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regimenlaboral extends Model
{
    use HasFactory;

    protected $table = 'regimen_laboral';

    protected $primaryKey='rl_id';

    protected $fillable = [
        'rl_id','rl_regimen_laboral'
    ];
}
