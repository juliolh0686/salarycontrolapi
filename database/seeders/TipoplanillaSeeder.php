<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoPlanilla;

class TipoplanillaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoPlanilla::create(['tp_descripcion' => 'CONTINUA']);
        TipoPlanilla::create(['tp_descripcion' => 'CONTINUA-B']);
        TipoPlanilla::create(['tp_descripcion' => 'OCASIONAL']);
        TipoPlanilla::create(['tp_descripcion' => 'COMPLEMENTARIA']);
    }
}
