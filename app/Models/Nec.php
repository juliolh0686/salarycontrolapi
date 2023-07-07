<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nec extends Model
{
    use HasFactory;

    protected $table = 'nec';

    protected $primaryKey='nec_id';

    protected $fillable = [
      'nec_id',
      'nec_nec',
      'nec_distrito',
      'nec_espe_responsable'
    ];
}
