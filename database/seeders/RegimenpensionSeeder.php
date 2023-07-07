<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Regimenpension;

class RegimenpensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Regimenpension::create(['rp_id' => 0,'rp_regimen_pension' => 'NINGUNO']);
        Regimenpension::create(['rp_id' => 1,'rp_regimen_pension' => 'DL. N° 20530']);
        Regimenpension::create(['rp_id' => 2,'rp_regimen_pension' => 'DL. N° 19990']);
        Regimenpension::create(['rp_id' => 3,'rp_regimen_pension' => 'LEY N° 28991 (AFP)']);
        Regimenpension::create(['rp_id' => 4,'rp_regimen_pension' => 'PENSIONISTA AFP']);
        Regimenpension::create(['rp_id' => 7,'rp_regimen_pension' => 'PENSIONISTA SNP']);
        Regimenpension::create(['rp_id' => 8,'rp_regimen_pension' => 'LEY 20530-PENSIONES']);
        Regimenpension::create(['rp_id' => 9,'rp_regimen_pension' => 'DS 051-88-PCM']);
    }
}
