<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Concepto;

class ConceptoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Concepto::create(['con_concepto' =>'+001','con_nombre' => 'Sueldo Base','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+002','con_nombre' => 'Bonif.Personal','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+003','con_nombre' => 'Asig.D.L. 25671','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+004','con_nombre' => 'Asig. D.S.081','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+006','con_nombre' => 'DS154-91-PCM','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+008','con_nombre' => 'Bonif. Familiar','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+009','con_nombre' => 'D.U. 080-94','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+010','con_nombre' => 'Refrig. y Mov.','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+012','con_nombre' => 'Bon. D.U. 90-96','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+013','con_nombre' => 'DS. 019-94-PCM','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+014','con_nombre' => 'DSE 021-92-PCM','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+017','con_nombre' => 'CVid.DS154-91EF','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+023','con_nombre' => 'Bonif.Escolar','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>10]);
        Concepto::create(['con_concepto' =>'+024','con_nombre' => 'Bon. Especial','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+025','con_nombre' => 'Reunificada','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+026','con_nombre' => 'DS261-91-EF IGV','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+028','con_nombre' => 'Bon.T.Serv.','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>10]);
        Concepto::create(['con_concepto' =>'+029','con_nombre' => 'Sepelio y luto','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>10]);
        Concepto::create(['con_concepto' =>'+032','con_nombre' => 'Grat.T.Serv.','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>10]);
        Concepto::create(['con_concepto' =>'+078','con_nombre' => 'DS011-93-ED','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+079','con_nombre' => 'D.L.25897','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+080','con_nombre' => 'D.L. 26504','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+082','con_nombre' => 'D.U.073-97','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+092','con_nombre' => 'Reintg. Manual','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+097','con_nombre' => 'djudicia','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+098','con_nombre' => 'ojudicia','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+099','con_nombre' => 'Reint Man No Af','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+100','con_nombre' => 'D.U.011-99','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+105','con_nombre' => 'DU 037-94','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+136','con_nombre' => 'Asig. Cargo','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+150','con_nombre' => 'Rem.Mensual','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+162','con_nombre' => 'Horas.Adic','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+164','con_nombre' => 'DS 153-91-EF','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+167','con_nombre' => 'Asig. Familiar','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+170','con_nombre' => 'Ley29702','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+177','con_nombre' => 'RIM_Ley 29944','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+178','con_nombre' => 'Comp.Extr.Tran.','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+181','con_nombre' => 'Valor_Principal','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+185','con_nombre' => 'incdif_est','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+206','con_nombre' => 'A.carg_dir_LRM','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+231','con_nombre' => 'Jor_Trab.Ad_lrm','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+248','con_nombre' => 'Vac_T_Afect','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+249','con_nombre' => 'Vac_T_No_Afect','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+259','con_nombre' => 'A.carg_dir_UGEL','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+261','con_nombre' => 'A.carg_jefe_Ges','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+263','con_nombre' => 'RM_Aux_Nom','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+264','con_nombre' => 'RM_Aux_Cont','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+271','con_nombre' => 'A.carg_esp_LRM','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+276','con_nombre' => 'CTS_Cont','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>10]);
        Concepto::create(['con_concepto' =>'+277','con_nombre' => 'Luto_Cont','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>10]);
        Concepto::create(['con_concepto' =>'+022','con_nombre' => 'Aguinaldo','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>10]);
        Concepto::create(['con_concepto' =>'-0001','con_nombre' => 'DL20530','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>1]);
        Concepto::create(['con_concepto' =>'-0002','con_nombre' => 'DL19990 SNP','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>1]);
        Concepto::create(['con_concepto' =>'-0004','con_nombre' => 'Dscto. Judicial','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>1]);
        Concepto::create(['con_concepto' =>'-0005','con_nombre' => 'Derr Administra','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>3]);
        Concepto::create(['con_concepto' =>'-0006','con_nombre' => 'Derr Magisteria','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>3]);
        Concepto::create(['con_concepto' =>'-0007','con_nombre' => 'Coop Educación','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>4]);
        Concepto::create(['con_concepto' =>'-0008','con_nombre' => 'Coop Capac Yupa','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>4]);
        Concepto::create(['con_concepto' =>'-0009','con_nombre' => 'IPSSVIDA','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>1]);
        Concepto::create(['con_concepto' =>'-0013','con_nombre' => 'Responsabilidad','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>1]);
        Concepto::create(['con_concepto' =>'-0015','con_nombre' => 'Sesdis','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>5]);
        Concepto::create(['con_concepto' =>'-0021','con_nombre' => 'Cafae-SE','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>3]);
        Concepto::create(['con_concepto' =>'-0023','con_nombre' => 'EDUCOOP','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>4]);
        Concepto::create(['con_concepto' =>'-0026','con_nombre' => 'Subcafae','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>3]);
        Concepto::create(['con_concepto' =>'-0029','con_nombre' => 'Multas Paros','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>1]);
        Concepto::create(['con_concepto' =>'-0054','con_nombre' => 'Tardanzas','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>1]);
        Concepto::create(['con_concepto' =>'-1010','con_nombre' => 'Coop.Sto Tomas','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>4]);
        Concepto::create(['con_concepto' =>'-0106','con_nombre' => 'presderese','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>3]);
        Concepto::create(['con_concepto' =>'-0109','con_nombre' => 'Licencia Aut.','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>1]);
        Concepto::create(['con_concepto' =>'-0110','con_nombre' => 'Licenc. Man. af','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>1]);
        Concepto::create(['con_concepto' =>'-0111','con_nombre' => 'Pago Ind. Man','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>1]);
        Concepto::create(['con_concepto' =>'-0113','con_nombre' => 'D.L. 25897 AFP','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>1]);
        Concepto::create(['con_concepto' =>'-1145','con_nombre' => 'Inasistencias','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>1]);
        Concepto::create(['con_concepto' =>'-1146','con_nombre' => 'Permisos','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>1]);
        Concepto::create(['con_concepto' =>'-0115','con_nombre' => 'pagindnoaf','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>1]);
        Concepto::create(['con_concepto' =>'-0121','con_nombre' => 'quintacat','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>1]);
        Concepto::create(['con_concepto' =>'-0129','con_nombre' => 'cooprosa','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>4]);
        Concepto::create(['con_concepto' =>'-0130','con_nombre' => 'coopsbenit','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>4]);
        Concepto::create(['con_concepto' =>'-0138','con_nombre' => 'Of Bec Cre Edu','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>6]);
        Concepto::create(['con_concepto' =>'-0139','con_nombre' => 'coopatla','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>4]);
        Concepto::create(['con_concepto' =>'-0140','con_nombre' => 'coopsmilag','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>4]);
        Concepto::create(['con_concepto' =>'-0143','con_nombre' => 'ARCIJAEL','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>6]);
        Concepto::create(['con_concepto' =>'-0151','con_nombre' => 'cmcusco','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>5]);
        Concepto::create(['con_concepto' =>'-1697','con_nombre' => 'FUTURA-LTA','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>4]);
        Concepto::create(['con_concepto' =>'-1728','con_nombre' => 'YEHOXUA','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>4]);
        Concepto::create(['con_concepto' =>'-0190','con_nombre' => 'cmtrujillo','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>5]);
        Concepto::create(['con_concepto' =>'-0417','con_nombre' => 'prderradm','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>3]);
        Concepto::create(['con_concepto' =>'-0418','con_nombre' => 'prderrmag','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>3]);
        Concepto::create(['con_concepto' =>'-0777','con_nombre' => 'juanxxiii','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>4]);
        Concepto::create(['con_concepto' =>'-0118','con_nombre' => 'Licmanoaf','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>1]);
        Concepto::create(['con_concepto' =>'-0856','con_nombre' => 'fentase','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>2]);
        Concepto::create(['con_concepto' =>'+186','con_nombre' => 'remvac_tru','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+262','con_nombre' => 'Ley 30372-89','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'essalu','con_nombre' => 'ESSALUD','tipo_conceptos_tc_id'=>3,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+090','con_nombre' => 'CredDevNaf','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>10]);
        Concepto::create(['con_concepto' =>'+033','con_nombre' => 'Cred.Deveng','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>10]);
        Concepto::create(['con_concepto' =>'+244','con_nombre' => 'Palmas MagEduc.','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>10]);
        Concepto::create(['con_concepto' =>'-1305','con_nombre' => 'cedeci','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>6]);
        Concepto::create(['con_concepto' =>'+233','con_nombre' => 'HRADCONT','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'-1763','con_nombre' => 'GPROEDUCAR','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>6]);
        Concepto::create(['con_concepto' =>'-1710','con_nombre' => 'SAN MIGUEL','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>4]);
        Concepto::create(['con_concepto' =>'+286','con_nombre' => '10 RMV','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>10]);
        Concepto::create(['con_concepto' =>'+251','con_nombre' => 'BONO1RM54','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>10]);
        Concepto::create(['con_concepto' =>'-1787','con_nombre' => 'DU.063-2020','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>2]);
        Concepto::create(['con_concepto' =>'+301','con_nombre' => 'ATS_29944','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>10]);
        Concepto::create(['con_concepto' =>'+302','con_nombre' => 'SLS_29944','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>10]);
        Concepto::create(['con_concepto' =>'+303','con_nombre' => 'CTS_29944','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>10]);
        Concepto::create(['con_concepto' =>'-1452','con_nombre' => 'Derrama Multise','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>3]);
        Concepto::create(['con_concepto' =>'-1784','con_nombre' => 'FENSUTACE','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>2]);
        Concepto::create(['con_concepto' =>'-1829','con_nombre' => 'ALTO_MONTESSORI','tipo_conceptos_tc_id'=>2,'grupos_descuentos_gd_id'=>4]);
        Concepto::create(['con_concepto' =>'+316','con_nombre' => 'BE_NC','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>10]);
        Concepto::create(['con_concepto' =>'+322','con_nombre' => 'Bon_Ley Nº31728','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>10]);
        Concepto::create(['con_concepto' =>'+288','con_nombre' => 'MUC_276','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+309','con_nombre' => 'B_Ext_Tran_Fijo','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+310','con_nombre' => 'B_Ext_Tran_Vari','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+323','con_nombre' => 'PSJ','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>10]);
        Concepto::create(['con_concepto' =>'+108','con_nombre' => 'ds065','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);
        Concepto::create(['con_concepto' =>'+057','con_nombre' => 'vactrunc','tipo_conceptos_tc_id'=>1,'grupos_descuentos_gd_id'=>0]);

    }
}
