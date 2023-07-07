<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $table = 'cargo';

    protected $primaryKey = 'car_id';

    protected $fillable = [
        'car_id',
        'car_cargo'
      ];

}
