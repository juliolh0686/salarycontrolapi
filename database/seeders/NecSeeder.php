<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nec;

class NecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nec::create(['nec_id' => '01','nec_nec' => 'NEC 01','nec_distrito' => 'SEDE CENTRAL', 'nec_espe_responsable'=>'JAIME RUIZ']);
        Nec::create(['nec_id' => '02','nec_nec' => 'NEC 02','nec_distrito' => 'SAN LUIS', 'nec_espe_responsable'=>'JAIME RUIZ']);
        Nec::create(['nec_id' => '03','nec_nec' => 'NEC 03','nec_distrito' => 'SAN BORJA', 'nec_espe_responsable'=>'ELCY VELASQUEZ']);
        Nec::create(['nec_id' => '04','nec_nec' => 'NEC 04','nec_distrito' => 'SURQUILLO', 'nec_espe_responsable'=>'ELCY VELASQUEZ']);
        Nec::create(['nec_id' => '05','nec_nec' => 'NEC 05','nec_distrito' => 'MIRAFLORES', 'nec_espe_responsable'=>'ELCY VELASQUEZ']);
        Nec::create(['nec_id' => '06','nec_nec' => 'NEC 06','nec_distrito' => 'BARRANCO', 'nec_espe_responsable'=>'ELCY VELASQUEZ']);
        Nec::create(['nec_id' => '07','nec_nec' => 'NEC 07','nec_distrito' => 'SURCO', 'nec_espe_responsable'=>'JAIME RUIZ']);
        Nec::create(['nec_id' => '08','nec_nec' => 'NEC 08','nec_distrito' => 'SURCO', 'nec_espe_responsable'=>'JAIME RUIZ']);
        Nec::create(['nec_id' => '09','nec_nec' => 'NEC 09','nec_distrito' => 'CHORRILLOS', 'nec_espe_responsable'=>'ESTEFANY MISAICO']);
        Nec::create(['nec_id' => '10','nec_nec' => 'NEC 10','nec_distrito' => 'CHORRILLOS', 'nec_espe_responsable'=>'ESTEFANY MISAICO']);
        Nec::create(['nec_id' => '11','nec_nec' => 'NEC 11','nec_distrito' => 'CHORRILLOS', 'nec_espe_responsable'=>'ESTEFANY MISAICO']);
        Nec::create(['nec_id' => '12','nec_nec' => 'NEC 12','nec_distrito' => 'CHORRILLOS', 'nec_espe_responsable'=>'ESTEFANY MISAICO']);
        Nec::create(['nec_id' => '13','nec_nec' => 'NEC 13','nec_distrito' => 'CHORRILLOS', 'nec_espe_responsable'=>'ESTEFANY MISAICO']);
    }
}
