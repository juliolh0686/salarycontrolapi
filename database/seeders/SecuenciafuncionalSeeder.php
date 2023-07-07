<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Secuenciafuncional;

class SecuenciafuncionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0001','sf_descripcion' => 'INICIAL - MAGISTERIO - NOMBRADO']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0002','sf_descripcion' => 'INICIAL - MAGISTERIO - CONTRATADO']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0003','sf_descripcion' => 'JOR.TRAB.AD. LRM - INICIAL']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0004','sf_descripcion' => 'PRIMARIA - MAGISTERIO - NOMBRADO']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0005','sf_descripcion' => 'PRIMARIA - MAGISTERIO - CONTRATADO']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0006','sf_descripcion' => 'JOR.TRAB.AD. LRM - PRIMARIA']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0007','sf_descripcion' => 'PROFESORES DE EDUCACIÓN FÍSICA -PRIMARIA']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0008','sf_descripcion' => 'TÉCNICOS DEPORTIVOS - PRIMARIA']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0009','sf_descripcion' => 'SECUNDARIA - MAGISTERIO - CONTRATADO']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0010','sf_descripcion' => 'SECUNDARIA - MAGISTERIO - NOMBRADO']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0011','sf_descripcion' => 'JOR.TRAB.AD. LRM - SECUNDARIA']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0012','sf_descripcion' => 'TÉCNICOS DEPORTIVOS - SECUNDARIA']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0013','sf_descripcion' => 'INICIAL - ADMINISTRATIVO']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0015','sf_descripcion' => 'PRIMARIA - ADMINISTRATIVO']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0018','sf_descripcion' => 'SECUNDARIA - ADMINISTRATIVO']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0034','sf_descripcion' => 'EDUCACION BASICA ESPECIAL - PRITE']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0036','sf_descripcion' => 'EDUCACION BASICA ESPECIAL - NOMBRADO']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0037','sf_descripcion' => 'EDUCACION BASICA ESPECIAL - CONTRATADO']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0038','sf_descripcion' => 'JOR.TRAB.AD. LRM - EBE']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0048','sf_descripcion' => 'GESTION ADMINISTRATIVA']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0051','sf_descripcion' => 'JOR.TRAB.AD. LRM - GESTION ADMINISTRATIVA']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0052','sf_descripcion' => 'BENEFICIOS SOCIALES - GESTION ADMINISTRATIVA']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0054','sf_descripcion' => 'GESTION DE RECURSOS HUMANOS']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0056','sf_descripcion' => 'FORMACION OCUPACIONAL']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0057','sf_descripcion' => 'FORMACION OCUPACIONAL']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0058','sf_descripcion' => 'JOR.TRAB.AD. LRM - FORMACION OCUPACIONAL']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0059','sf_descripcion' => 'EBA SECUNDARIA ADULTOS']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0060','sf_descripcion' => 'EBA SECUNDARIA ADULTOS']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0061','sf_descripcion' => 'JOR.TRAB.AD. LRM - EBA SECUNDARIA ADULTOS']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0062','sf_descripcion' => 'EBA PRIMARIA ADULTOS']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0063','sf_descripcion' => 'EBA PRIMARIA ADULTOS']);
        Secuenciafuncional::create(['sf_anio' => '2023','sf_secuencia_funcional' => '0065','sf_descripcion' => 'JOR.TRAB.AD. LRM - EBA PRIMARIA ADULTOS']);
    }
}
