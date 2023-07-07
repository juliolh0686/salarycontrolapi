<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clasificador;

class ClasificadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clasificador::create(['cl_clasificador' => '2.1.12.11','cl_descripcion' => 'PERSONAL NOMBRADO - DOCENTE']);
        Clasificador::create(['cl_clasificador' => '2.1.12.12','cl_descripcion' => 'PERSONAL CONTRATADO - DOCENTE']);
        Clasificador::create(['cl_clasificador' => '2.1.12.21','cl_descripcion' => 'ASIGNACIONES Y BONIFICACIONES PARA EL PERSONAL DEL MAGISTERIO']);
        Clasificador::create(['cl_clasificador' => '2.1.12.299','cl_descripcion' => 'OTRAS RETRIBUCIONES Y COMPLEMENTOS']);
        Clasificador::create(['cl_clasificador' => '2.1.12.31','cl_descripcion' => 'PERSONAL AUXILIAR DE EDUCACION']);
        Clasificador::create(['cl_clasificador' => '2.1.19.12','cl_descripcion' => 'AGUINALDOS']);
        Clasificador::create(['cl_clasificador' => '2.1.19.13','cl_descripcion' => 'BONIFICACION POR ESCOLARIDAD']);
        Clasificador::create(['cl_clasificador' => '2.1.19.33','cl_descripcion' => 'COMPENSACION VACACIONAL (VACACIONES TRUNCAS)']);
        Clasificador::create(['cl_clasificador' => '2.1.31.15','cl_descripcion' => 'CONTRIBUCIONES A ESSALUD']);
        Clasificador::create(['cl_clasificador' => '2.2.23.42','cl_descripcion' => 'GASTOS DE SEPELIO Y LUTO DEL PERSONAL ACTIVO']);
        Clasificador::create(['cl_clasificador' => '2.1.11.12','cl_descripcion' => 'PERSONAL ADMINISTRATIVO NOMBRADO (REGIMEN PUBLICO)']);
        Clasificador::create(['cl_clasificador' => '2.1.11.13','cl_descripcion' => 'PERSONAL CON CONTRATO A PLAZO FIJO (REGIMEN LABORAL PUBLICO)']);
        Clasificador::create(['cl_clasificador' => '2.1.11.21','cl_descripcion' => 'ASIGNACION A FONDOS PARA PERSONAL']);
        Clasificador::create(['cl_clasificador' => '2.1.13.11','cl_descripcion' => 'PERSONAL NOMBRADO - SALUD']);
        Clasificador::create(['cl_clasificador' => '2.1.19.21','cl_descripcion' => 'COMPENSACION POR TIEMPO DE SERVICIOS (CTS)']);
        Clasificador::create(['cl_clasificador' => '2.1.19.31','cl_descripcion' => 'ASIGNACION POR CUMPLIR 25 O 30 AÑOS']);
        Clasificador::create(['cl_clasificador' => '2.1.13.12','cl_descripcion' => 'PERSONAL CONTRATADO - SALUD']);
        Clasificador::create(['cl_clasificador' => '2.1.12.22','cl_descripcion' => 'PALMAS MAGISTERIALES']);
        Clasificador::create(['cl_clasificador' => '2.1.11.299','cl_descripcion' => 'OTRAS RETRIBUCIONES Y COMPLEMENTOS']);
        Clasificador::create(['cl_clasificador' => '2.2.21.31','cl_descripcion' => 'GASTOS DE SEPELIO Y LUTO DEL PERSONAL ACTIVO']);
    }
}
