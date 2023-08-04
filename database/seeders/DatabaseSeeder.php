<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tipodocumento;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   
    public function run(): void
    {
        //Realizar la Carga de Base de Datos por Defecto
        $this->call([
            SexoSeeder::class,
            TipodocumentoSeeder::class,
            SituacionpersonalSeeder::class,
            NacionalidadSeeder::class,
            NecSeeder::class,
            SecuenciafuncionalSeeder::class,
            NivelSeeder::class,
            EstablecimientoSeeder::class,
            ClasificadorSeeder::class,
            TiposervidorSeeder::class,
            CargoSeeder::class,
            RegimenpensionSeeder::class,
            AdminpensionSeeder::class,
            RegimenlaboralSeeder::class,
            EstadoplanillaSeeder::class,
            TipoplanillaSeeder::class,
            TipoconceptosSeeder::class,
            GrupodescuentosSeeder::class,
            ConceptoSeeder::class
        ]);
    }
}
