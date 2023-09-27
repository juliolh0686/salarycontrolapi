<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adminpension extends Model
{
    use HasFactory;

    protected $table = 'admin_pension';

    protected $primaryKey = 'ap_id';

    protected $fillable = [
        'ap_id',
        'rp_admin_pension',
        'ap_group'
      ];
}
