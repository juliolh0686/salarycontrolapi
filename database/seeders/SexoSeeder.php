<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sexo;

class SexoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sexo::create([
            's_id' =>0,
            's_sexo' => 'MASCULINO'
        ]);
        
        Sexo::create([
            's_id' =>1,
            's_sexo' => 'FEMENINO'
        ]);

        Sexo::create([
            's_id' =>2,
            's_sexo' => 'SIN DATOS'
        ]);
    }
}
