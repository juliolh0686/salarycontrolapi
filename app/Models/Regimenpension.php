<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regimenpension extends Model
{
    use HasFactory;

    protected $table = 'regimen_pension';

    protected $primaryKey='rp_id';

    protected $fillable = [
        'rp_id','rp_regimen_pension'
    ];
}
