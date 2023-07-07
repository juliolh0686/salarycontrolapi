<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nivel;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nivel::create(['n_id' => '00','n_nivel' => 'SEDE CENTRAL','sec_cod_sec_fun' => 23]);
        Nivel::create(['n_id' => '01','n_nivel' => 'EBR NIVEL INICIAL-JARDINES','sec_cod_sec_fun' => 1]);
        Nivel::create(['n_id' => '02','n_nivel' => 'EBR NIVEL PRIMARIA','sec_cod_sec_fun' => 4]);
        Nivel::create(['n_id' => '03','n_nivel' => 'EBR NIVEL SECUNDARIA','sec_cod_sec_fun' => 9]);
        Nivel::create(['n_id' => '04','n_nivel' => 'EBA CICLO INICIAL E INTERMEDIO','sec_cod_sec_fun' => 30]);
        Nivel::create(['n_id' => '05','n_nivel' => 'ETP CICLO BASICO','sec_cod_sec_fun' => 24]);
        Nivel::create(['n_id' => '07','n_nivel' => 'EBA CICLO AVANZADO','sec_cod_sec_fun' => 27]);
        Nivel::create(['n_id' => '08','n_nivel' => 'EBE NIVEL PRIMARIA','sec_cod_sec_fun' => 17]);
        Nivel::create(['n_id' => '09','n_nivel' => 'EBR NIVEL INICIAL-CUNAS','sec_cod_sec_fun' => 1]);
        Nivel::create(['n_id' => '0V','n_nivel' => 'MINISTERIO DE DEFENZA','sec_cod_sec_fun' => 1]);
    }
}
