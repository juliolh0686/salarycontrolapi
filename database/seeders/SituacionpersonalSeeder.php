<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Situacionpersonal;

class SituacionpersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Situacionpersonal::create([
            'sp_id' => 1,
            'sp_situacion' => 'LICENCIA SIN GOCE'
        ]);

        Situacionpersonal::create([
            'sp_id' => 2,
            'sp_situacion' => 'LICENCIA CON GOCE ESSALUD'
        ]);

        Situacionpersonal::create([
            'sp_id' => 3,
            'sp_situacion' => 'FALLECIDO'
        ]);

        Situacionpersonal::create([
            'sp_id' => 4,
            'sp_situacion' => 'HABILITADO'
        ]);

        Situacionpersonal::create([
            'sp_id' => 5,
            'sp_situacion' => 'BAJA'
        ]);

        Situacionpersonal::create([
            'sp_id' => 6,
            'sp_situacion' => 'LICENCIA CON GOCE OTROS'
        ]);

        Situacionpersonal::create([
            'sp_id' => 7,
            'sp_situacion' => 'REMUNERACION VACACIONAL'
        ]);

        Situacionpersonal::create([
            'sp_id' => 8,
            'sp_situacion' => 'ABANDONO DE CARGO'
        ]);

        Situacionpersonal::create([
            'sp_id' => 9,
            'sp_situacion' => 'SUSPENSION POR SANCION'
        ]);

        Situacionpersonal::create([
            'sp_id' => 10,
            'sp_situacion' => 'REC. PARA EFECTO DE PAGO'
        ]);

        Situacionpersonal::create([
            'sp_id' => 11,
            'sp_situacion' => 'MEDIDA PEVENTIVA'
        ]);

        Situacionpersonal::create([
            'sp_id' => 18,
            'sp_situacion' => 'SUSPENDIDO'
        ]);

        Situacionpersonal::create([
            'sp_id' => 55,
            'sp_situacion' => 'PAGO OCASIONAL'
        ]);
        
    }
}
