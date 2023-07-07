<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estadoplanilla;

class EstadoplanillaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estadoplanilla::create(['ep_id' => 1,'ep_estado' => 'ACTIVO']);
        Estadoplanilla::create(['ep_id' => 2,'ep_estado' => 'CERRADO']);
    }
}
