<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tiposervidor;

class TiposervidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tiposervidor::create(['ts_id' => 1,'ts_tipo_servidor' => 'DOCENTE NOMBRADO','clasificador_cl_id' => 1]);
        Tiposervidor::create(['ts_id' => 2,'ts_tipo_servidor' => 'DOCENTE CONTRATADO','clasificador_cl_id' => 2]);
        Tiposervidor::create(['ts_id' => 3,'ts_tipo_servidor' => 'ADMINISTRATIVO NOMBRADO','clasificador_cl_id' => 11]);
        Tiposervidor::create(['ts_id' => 4,'ts_tipo_servidor' => 'ADMINISTRATIVO CONTRATADO','clasificador_cl_id' => 12]);
        Tiposervidor::create(['ts_id' => 5,'ts_tipo_servidor' => 'ADM. SERV. NOMBRADO','clasificador_cl_id' => 11]);
        Tiposervidor::create(['ts_id' => 6,'ts_tipo_servidor' => 'ADM. SERV. CONTRATADO','clasificador_cl_id' => 12]);
        Tiposervidor::create(['ts_id' => 7,'ts_tipo_servidor' => 'AUXILIAR CONTRATADO','clasificador_cl_id' => 5]);
        Tiposervidor::create(['ts_id' => 8,'ts_tipo_servidor' => 'AUXILIAR NOMBRADO','clasificador_cl_id' => 5]);
        Tiposervidor::create(['ts_id' => 9,'ts_tipo_servidor' => 'PROF. SALUD NOMBRADO','clasificador_cl_id' => 14]);
        Tiposervidor::create(['ts_id' => 11,'ts_tipo_servidor' => 'PROF. SALUD CONTRATADO','clasificador_cl_id' => 17]);
        Tiposervidor::create(['ts_id' => 12,'ts_tipo_servidor' => 'PALMAS MAGISTERIALES','clasificador_cl_id' => 18]);
    }
}
