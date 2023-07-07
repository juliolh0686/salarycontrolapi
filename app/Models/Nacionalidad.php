<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    use HasFactory;

    protected $table = 'nacionalidad';

    protected $primaryKey='n_id';

    protected $fillable = [
      'n_id',
      'n_nacionalidad'
    ];
}
