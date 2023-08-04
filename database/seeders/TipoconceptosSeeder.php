<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tipoconceptos;

class TipoconceptosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tipoconceptos::create(['tc_id' =>1,'tc_tipo' => 'INGRESOS']);
        Tipoconceptos::create(['tc_id' =>2,'tc_tipo' => 'DESCUENTOS']);
        Tipoconceptos::create(['tc_id' =>3,'tc_tipo' => 'APORTES']);
    }
}
