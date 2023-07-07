<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Adminpension;

class AdminpensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Adminpension::create(['ap_id' => 0,'rp_admin_pension' => 'SIN DEFINIR']);
        Adminpension::create(['ap_id' => 1,'rp_admin_pension' => 'HORIZONTE']);
        Adminpension::create(['ap_id' => 2,'rp_admin_pension' => 'INTEGRA']);
        Adminpension::create(['ap_id' => 5,'rp_admin_pension' => 'PROFUTURO']);
        Adminpension::create(['ap_id' => 9,'rp_admin_pension' => 'PRIMA']);
        Adminpension::create(['ap_id' => 10,'rp_admin_pension' => 'HORIZONTE MIXTA']);
        Adminpension::create(['ap_id' => 11,'rp_admin_pension' => 'INTEGRA MIXTA']);
        Adminpension::create(['ap_id' => 12,'rp_admin_pension' => 'PROFUTURO MIXTA']);
        Adminpension::create(['ap_id' => 13,'rp_admin_pension' => 'PRIMA MIXTA']);
        Adminpension::create(['ap_id' => 14,'rp_admin_pension' => 'HABITAT MIXTA']);
        Adminpension::create(['ap_id' => 15,'rp_admin_pension' => 'HABITAT']);
    }
}
