<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tipodocumento;

class TipodocumentoSeeder extends Seeder
{
    
    public function run(): void
    {
        Tipodocumento::create([
            'td_id' => 1,
            'td_tipo_documento' => 'DOCUMENTO NACIONAL DE IDENTIDAD'
        ]);

        Tipodocumento::create([
            'td_id' => 5,
            'td_tipo_documento' => 'CARNET DE EXTRANJERIA'
        ]);
    }
}
