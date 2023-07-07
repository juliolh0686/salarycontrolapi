<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    use HasFactory;

    protected $table = 'establecimiento';

    protected $primaryKey='est_id';

    protected $fillable = [
      'est_id',
      'est_establecimiento'
    ];
}
