<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nacionalidad;

class NacionalidadSeeder extends Seeder
{

    public function run(): void
    {
        Nacionalidad::create([
            'n_id' => 1,
            'n_nacionalidad' => 'SIN INFORMACION'
        ]);

        Nacionalidad::create([
            'n_id' => 2,
            'n_nacionalidad' => 'PERUANO(A)'
        ]);

        Nacionalidad::create([
            'n_id' => 6,
            'n_nacionalidad' => 'VENEZOLANO(A)'
        ]);
    }
}
