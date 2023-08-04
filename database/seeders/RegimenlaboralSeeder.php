<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Regimenlaboral;

class RegimenlaboralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Regimenlaboral::create(['rl_id' => 1,'rl_regimen_laboral' => 'LEY N° 24029']);
        Regimenlaboral::create(['rl_id' => 3,'rl_regimen_laboral' => 'DL. N° 276']);
        Regimenlaboral::create(['rl_id' => 6,'rl_regimen_laboral' => 'DL. N° 1153']);
        Regimenlaboral::create(['rl_id' => 8,'rl_regimen_laboral' => 'LEY N° 29944']);
        Regimenlaboral::create(['rl_id' => 9,'rl_regimen_laboral' => 'SIN REGIMEN']);
        Regimenlaboral::create(['rl_id' => 10,'rl_regimen_laboral' => 'DL. N° 1153']);
        Regimenlaboral::create(['rl_id' => 12,'rl_regimen_laboral' => 'LEY N° 30328']);
        Regimenlaboral::create(['rl_id' => 14,'rl_regimen_laboral' => 'LEY N° 29944 (LEY N° 30493)']);
        Regimenlaboral::create(['rl_id' => 16,'rl_regimen_laboral' => 'LEY N° 29944']);
    }
}
