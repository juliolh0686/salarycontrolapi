<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grupodescuentos;

class GrupodescuentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grupodescuentos::create(['gd_id' =>0,'gd_grupo' => 'INGRESO NETO']);
        Grupodescuentos::create(['gd_id' =>1,'gd_grupo' => 'DE LEY Y POR MANDATO JUDICIAL']);
        Grupodescuentos::create(['gd_id' =>2,'gd_grupo' => 'SINDICALES']);
        Grupodescuentos::create(['gd_id' =>3,'gd_grupo' => 'FONDOS DE BIENESTAR']);
        Grupodescuentos::create(['gd_id' =>4,'gd_grupo' => 'COOPERATIVAS']);
        Grupodescuentos::create(['gd_id' =>5,'gd_grupo' => 'ENTIDADES SUPERVISADAS Y REGULADAS POR LA SBS Y AFP']);
        Grupodescuentos::create(['gd_id' =>6,'gd_grupo' => 'ENTIDADES CON CONVENIOS AUN VIGENTES']);
        Grupodescuentos::create(['gd_id' =>10,'gd_grupo' => 'INGRESO NO NETO']);


    }
}
