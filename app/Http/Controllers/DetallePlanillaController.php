<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Personal;
use App\Models\Planilla;
use App\Models\Detalleplanilla;
use App\Models\Planillaconceptos;
use Illuminate\Support\Facades\Auth;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DetallePlanillaController extends Controller
{
    public function import149(Request $request)
    {

      $tipocarga = $request->tipocarga;

      try {
        
        $tipoarchivo=$request->file;

        //Recibimos el archivo y lo guardamos en la carpeta storage/app/public
        $path = $request->file('file')->store('public');

        //Hallamos el nombre del archivo
        $path_array = explode("/", $path);
        $path_nombre = $path_array[1];

        header('Content-Type: text/html; charset=UTF-8');

        //indicamos el delimitador
        $cardelimitador = '|';

        //hallamos la carpeta donde se guarda el archivo
        $carpeta = public_path().'/storage/';

        //abrimos el archivo
        $oa = fopen($carpeta.$path_nombre, 'r');

        //SELECCIONAR PLANILLA
        $select_planilla = Planilla::where('estado_planilla_ep_id','=',1)->get()->first();
        $id_planilla = $select_planilla->pll_id;

        $c = 0;

        if($tipocarga == "continua") {

          //******INICIO CARGA PLANILLA CONTINUA*****

          while($a = fgetcsv($oa,1000, $cardelimitador)){

            //--DATOS PERSONALES--//
            $p_id=ltrim($a[1]);
            $p_a_paterno=mb_convert_encoding(trim($a[5]),"UTF-8","ISO-8859-1");
            $p_a_materno=mb_convert_encoding(trim($a[6]),"UTF-8","ISO-8859-1");
            $p_nombres=mb_convert_encoding(trim($a[7]),"UTF-8","ISO-8859-1");
            $sexo_p_sexo=trim($a[8]);
            $p_fech_nac=trim($a[9]);
            $p_tip_doc=trim($a[10]);
            $p_num_doc=trim($a[11]);
            $nacionalidad_n_id=trim($a[12]);
  
            $mifecha = explode("/", $p_fech_nac);
            $lafecha=$mifecha[2]."-".$mifecha[1]."-".$mifecha[0]; 
            $p_fech_nac= $lafecha;
  
            //DATOS LABORALES
            $dp_cod_registro=ltrim($a[1]).trim($a[2]);
            $dp_cod_cargo=trim($a[2]);
            $situacion_personal_sp_id=trim($a[4]);
            $nec_nec_id=trim($a[14]);
            $nivel_n_id=trim($a[15]);
            $establecimiento_est_id=trim($a[16]);
            $dp_plaza=mb_convert_encoding(trim($a[18]),"UTF-8","ISO-8859-1");
            $pd_dias_lab=trim($a[19]);
            $dp_fech_ini=trim($a[20]);
            $dp_fech_term=trim($a[21]);
            $tipo_servidor_ts_id=trim($a[23]);
            $dp_nivel_mag=trim($a[24]);
            $dp_nivel_magref=trim($a[25]);
            $dp_categoria_rem=trim($a[26]);
            $dp_jor_lab=trim($a[27]);
            $cargo_car_id=trim($a[28]);
            $regimen_pension_rp_id=trim($a[33]);
            $dp_seg_salud=trim($a[34]);
            $dp_num_segsalud=mb_convert_encoding(trim($a[35]),"UTF-8","ISO-8859-1");
            $admin_pension_ap_id=trim($a[36]);
            $dp_cuspp=mb_convert_encoding(trim($a[37]),"UTF-8","ISO-8859-1");
            $dp_fech_afi=trim($a[38]);
            $dp_fech_dev=trim($a[39]);
            $dp_tip_encarg=trim($a[40]);
            $dp_tipo_plaza=trim($a[43]);
            $dp_dias_lic=trim($a[44]);
            $dp_fech_ini_lic=trim($a[45]);
            $dp_cuenta=trim($a[54]);
            $dp_leyenda_mensual=mb_convert_encoding(trim($a[55]),"UTF-8","ISO-8859-1");
            $dp_leyenda_permanente=mb_convert_encoding(trim($a[56]),"UTF-8","ISO-8859-1");
            $regimen_laboral_rl_id=trim($a[58]);
            $dp_horas_adicionales= trim($a[57]);
            $dp_cod_nexus=mb_convert_encoding(trim($a[60]),"UTF-8","ISO-8859-1");
            $dp_bruto=trim($a[61]);
            $dp_afecto=trim($a[62]);
            $dp_desc=trim($a[63]);
            $dp_liquido=trim($a[64]);
            $dp_essalud=trim($a[65]);
  
            if(strlen($nivel_n_id)==1){
              $nivel_n_id='0'.$nivel_n_id;
            }

            $mifecha = explode("/", $dp_fech_ini);
            $lafecha=$mifecha[2]."-".$mifecha[1]."-".$mifecha[0]; 
            $dp_fech_ini= $lafecha;
  
            $mifecha = explode("/", $dp_fech_term);
            $lafecha=$mifecha[2]."-".$mifecha[1]."-".$mifecha[0]; 
            $dp_fech_term= $lafecha;
  
            if($dp_fech_afi=='01/01/1900'){
              $dp_fech_afi= null;
            }else {
              $mifecha = explode("/", $dp_fech_afi);
              $lafecha=$mifecha[2]."-".$mifecha[1]."-".$mifecha[0]; 
              $dp_fech_afi= $lafecha;
            }
  
            if($dp_fech_dev=='01/01/1900'){
              $dp_fech_dev= null;
            }else {
              $mifecha = explode("/", $dp_fech_dev);
              $lafecha=$mifecha[2]."-".$mifecha[1]."-".$mifecha[0]; 
              $dp_fech_dev= $lafecha;
            }
  
            if($dp_fech_ini_lic=='01/01/1900'){
              $dp_fech_ini_lic= null;
            }else {
              $mifecha = explode("/", $dp_fech_ini_lic);
              $lafecha=$mifecha[2]."-".$mifecha[1]."-".$mifecha[0]; 
              $dp_fech_ini_lic= $lafecha;
            }
  
            if(strlen($dp_cuenta)==10) {
              $dp_cuenta="0".$dp_cuenta;
            }
  
            //INSERTAR PERSONAL
            $personal = Personal::firstOrCreate(
              ['p_id' => $p_id],
              ['p_id' => $p_id,
              'p_a_paterno' => $p_a_paterno,
              'p_a_materno' => $p_a_materno,
              'p_nombres' => $p_nombres,
              'sexo_p_sexo' => $sexo_p_sexo,
              'p_fech_nac' => $p_fech_nac,
              'p_tip_doc' => $p_tip_doc,
              'p_num_doc' => $p_num_doc,
              'nacionalidad_n_id' => $nacionalidad_n_id],
            );
  
             //INSERTAR DETALLE PLANILLA
            $detalle_planilla= new Detalleplanilla();
            $detalle_planilla->dp_cod_registro=$dp_cod_registro;
            $detalle_planilla->dp_cod_cargo = $dp_cod_cargo;
            $detalle_planilla->situacion_personal_sp_id = $situacion_personal_sp_id;
            $detalle_planilla->nec_nec_id = $nec_nec_id;
            $detalle_planilla->nivel_n_id = $nivel_n_id;
            $detalle_planilla->establecimiento_est_id = $establecimiento_est_id;
            $detalle_planilla->dp_plaza = $dp_plaza;
            $detalle_planilla->pd_dias_lab = $pd_dias_lab;
            $detalle_planilla->dp_fech_ini = $dp_fech_ini;
            $detalle_planilla->dp_fech_term = $dp_fech_term;
            $detalle_planilla->tipo_servidor_ts_id = $tipo_servidor_ts_id;
            $detalle_planilla->dp_nivel_mag = $dp_nivel_mag;
            $detalle_planilla->dp_nivel_magref = $dp_nivel_magref;
            $detalle_planilla->dp_categoria_rem = $dp_categoria_rem;
            $detalle_planilla->dp_jor_lab = $dp_jor_lab;
            $detalle_planilla->cargo_car_id = $cargo_car_id;
            $detalle_planilla->regimen_pension_rp_id = $regimen_pension_rp_id;
            $detalle_planilla->dp_seg_salud = $dp_seg_salud;
            $detalle_planilla->dp_num_segsalud = $dp_num_segsalud;
            $detalle_planilla->admin_pension_ap_id = $admin_pension_ap_id;
            $detalle_planilla->dp_cuspp = $dp_cuspp;
            $detalle_planilla->dp_fech_afi = $dp_fech_afi;
            $detalle_planilla->dp_fech_dev = $dp_fech_dev;
            $detalle_planilla->dp_tip_encarg = $dp_tip_encarg;
            $detalle_planilla->dp_tipo_plaza = $dp_tipo_plaza;
            $detalle_planilla->dp_dias_lic = $dp_dias_lic;
            $detalle_planilla->dp_fech_ini_lic = $dp_fech_ini_lic;
            $detalle_planilla->dp_cuenta = $dp_cuenta;
            $detalle_planilla->dp_leyenda_mensual = $dp_leyenda_mensual;
            $detalle_planilla->dp_leyenda_permanente = $dp_leyenda_permanente;
            $detalle_planilla->regimen_laboral_rl_id = $regimen_laboral_rl_id;
            $detalle_planilla->dp_horas_adicionales = $dp_horas_adicionales;
            $detalle_planilla->dp_cod_nexus = $dp_cod_nexus;
            $detalle_planilla->dp_bruto = $dp_bruto;
            $detalle_planilla->dp_afecto = $dp_afecto;
            $detalle_planilla->dp_desc = $dp_desc;
            $detalle_planilla->dp_liquido = $dp_liquido;
            $detalle_planilla->dp_essalud = $dp_essalud;
            $detalle_planilla->dp_noabono = 0;
            $detalle_planilla->planilla_pll_id = $id_planilla;
            $detalle_planilla->personal_p_id = $p_id;
            if($situacion_personal_sp_id=='55'){
              $detalle_planilla->tipo_planilla_tp_id = 2;
            }else {
              $detalle_planilla->tipo_planilla_tp_id = 1;
            }
            $detalle_planilla->save();
            
            //Conteo de registros
            $c++;
  
          }
          //****FIN CARGA PLANILLA CONTINUA****

        }elseif($tipocarga=="ocasional") {

          //****INICIO DE CARGA PLANILLA OCASIONAL****

          while($a = fgetcsv($oa,1000, $cardelimitador)){

            $verificar_oca=trim($a[5]);

            if($verificar_oca=='55'){

              //--DATOS PERSONALES--//
              $p_id='10'.trim($a[14]);
              $p_a_paterno=mb_convert_encoding(trim($a[6]),"UTF-8","ISO-8859-1");
              $p_a_materno=mb_convert_encoding(trim($a[7]),"UTF-8","ISO-8859-1");
              $p_nombres=mb_convert_encoding(trim($a[8]),"UTF-8","ISO-8859-1");
              $p_fech_nac=trim($a[12]);
              $p_tip_doc=trim($a[13]);
              $p_num_doc=trim($a[14]);

              //SIN DATOS
              $sexo_p_sexo=2;
              $nacionalidad_n_id=1;

              $mifecha = explode("/", $p_fech_nac);
              $lafecha=$mifecha[2]."-".$mifecha[1]."-".$mifecha[0]; 
              $p_fech_nac= $lafecha;


              //--DATOS LABORALES--//
              $dp_cod_registro=$p_id.trim($a[2]);
              $dp_cod_cargo=trim($a[2]);
              $situacion_personal_sp_id=trim($a[5]);
              $nec_nec_id=substr(trim($a[9]),2,2);
              $nivel_n_id=substr(trim($a[9]),4,1);
              $establecimiento_est_id=trim($a[9]);
              $tipo_servidor_ts_id=trim($a[33]);
              $cargo_car_id=trim($a[36]);
              $regimen_pension_rp_id=trim($a[34]);
              $admin_pension_ap_id=trim($a[35]);
              $dp_cuenta=trim($a[16]);
              $dp_leyenda_permanente=mb_convert_encoding(trim($a[17]),"UTF-8","ISO-8859-1");
              $dp_bruto=trim($a[22]);
              $dp_afecto=trim($a[23]);
              $dp_desc=trim($a[24]);
              $dp_liquido=trim($a[25]);
              $dp_essalud=trim($a[26]);

              //SININFORMACION
              $regimen_laboral_rl_id=9;

              if(strlen($nivel_n_id)==1){
                $nivel_n_id='0'.$nivel_n_id;
              }
    
              if(strlen($dp_cuenta)==10) {
                $dp_cuenta="0".$dp_cuenta;
              }
    
              //INSERTAR PERSONAL
              $personal = Personal::firstOrCreate(
                ['p_id' => $p_id],
                ['p_id' => $p_id,
                'p_a_paterno' => $p_a_paterno,
                'p_a_materno' => $p_a_materno,
                'p_nombres' => $p_nombres,
                'sexo_p_sexo' => $sexo_p_sexo,
                'p_fech_nac' => $p_fech_nac,
                'p_tip_doc' => $p_tip_doc,
                'p_num_doc' => $p_num_doc,
                'nacionalidad_n_id' => $nacionalidad_n_id],
              );
    
               //INSERTAR DETALLE PLANILLA
              $detalle_planilla= new Detalleplanilla();
              $detalle_planilla->dp_cod_registro=$dp_cod_registro;
              $detalle_planilla->dp_cod_cargo = $dp_cod_cargo;
              $detalle_planilla->situacion_personal_sp_id = $situacion_personal_sp_id;
              $detalle_planilla->nec_nec_id = $nec_nec_id;
              $detalle_planilla->nivel_n_id = $nivel_n_id;
              $detalle_planilla->establecimiento_est_id = $establecimiento_est_id;
              $detalle_planilla->tipo_servidor_ts_id = $tipo_servidor_ts_id;
              $detalle_planilla->cargo_car_id = $cargo_car_id;
              $detalle_planilla->regimen_pension_rp_id = $regimen_pension_rp_id;
              $detalle_planilla->admin_pension_ap_id = $admin_pension_ap_id;
              $detalle_planilla->dp_cuenta = $dp_cuenta;
              $detalle_planilla->dp_leyenda_permanente = $dp_leyenda_permanente;
              $detalle_planilla->regimen_laboral_rl_id = $regimen_laboral_rl_id;
              $detalle_planilla->dp_bruto = $dp_bruto;
              $detalle_planilla->dp_afecto = $dp_afecto;
              $detalle_planilla->dp_desc = $dp_desc;
              $detalle_planilla->dp_liquido = $dp_liquido;
              $detalle_planilla->dp_essalud = $dp_essalud;
              $detalle_planilla->dp_noabono = 0;
              $detalle_planilla->planilla_pll_id = $id_planilla;
              $detalle_planilla->personal_p_id = $p_id;
              $detalle_planilla->tipo_planilla_tp_id = 3;
              $detalle_planilla->save();
    
              //Conteo de registros
              $c++;

            }
  
          }
      
          //****FIN DE CARGA PLANILLA OCASIONAL****

        }elseif($tipocarga=="complementaria") {

          //****INICIO DE CARGA PLANILLA COMPLEMENTARIA****
           
          while($a = fgetcsv($oa,1000, $cardelimitador)){

            //--DATOS PERSONALES--//
            $p_id=ltrim($a[1]);
            $p_a_paterno=mb_convert_encoding(trim($a[5]),"UTF-8","ISO-8859-1");
            $p_a_materno=mb_convert_encoding(trim($a[6]),"UTF-8","ISO-8859-1");
            $p_nombres=mb_convert_encoding(trim($a[7]),"UTF-8","ISO-8859-1");
            $sexo_p_sexo=trim($a[8]);
            $p_fech_nac=trim($a[9]);
            $p_tip_doc=trim($a[10]);
            $p_num_doc=trim($a[11]);
            $nacionalidad_n_id=trim($a[12]);
  
            $mifecha = explode("/", $p_fech_nac);
            $lafecha=$mifecha[2]."-".$mifecha[1]."-".$mifecha[0]; 
            $p_fech_nac= $lafecha;
  
            //DATOS LABORALES
            $dp_cod_registro=ltrim($a[1]).trim($a[2]);
            $dp_cod_cargo=trim($a[2]);
            $situacion_personal_sp_id=trim($a[4]);
            $nec_nec_id=trim($a[14]);
            $nivel_n_id=trim($a[15]);
            $establecimiento_est_id=trim($a[16]);
            $dp_plaza=mb_convert_encoding(trim($a[18]),"UTF-8","ISO-8859-1");
            $pd_dias_lab=trim($a[19]);
            $dp_fech_ini=trim($a[20]);
            $dp_fech_term=trim($a[21]);
            $tipo_servidor_ts_id=trim($a[23]);
            $dp_nivel_mag=trim($a[24]);
            $dp_nivel_magref=trim($a[25]);
            $dp_categoria_rem=trim($a[26]);
            $dp_jor_lab=trim($a[27]);
            $cargo_car_id=trim($a[28]);
            $regimen_pension_rp_id=trim($a[33]);
            $dp_seg_salud=trim($a[34]);
            $dp_num_segsalud=mb_convert_encoding(trim($a[35]),"UTF-8","ISO-8859-1");
            $admin_pension_ap_id=trim($a[36]);
            $dp_cuspp=mb_convert_encoding(trim($a[37]),"UTF-8","ISO-8859-1");
            $dp_fech_afi=trim($a[38]);
            $dp_fech_dev=trim($a[39]);
            $dp_tip_encarg=trim($a[40]);
            $dp_tipo_plaza=trim($a[43]);
            $dp_dias_lic=trim($a[44]);
            $dp_fech_ini_lic=trim($a[45]);
            $dp_cuenta=trim($a[54]);
            $dp_leyenda_mensual=mb_convert_encoding(trim($a[55]),"UTF-8","ISO-8859-1");
            $dp_leyenda_permanente=mb_convert_encoding(trim($a[56]),"UTF-8","ISO-8859-1");
            $regimen_laboral_rl_id=trim($a[58]);
            $dp_horas_adicionales= trim($a[57]);
            $dp_cod_nexus=mb_convert_encoding(trim($a[60]),"UTF-8","ISO-8859-1");
            $dp_bruto=trim($a[61]);
            $dp_afecto=trim($a[62]);
            $dp_desc=trim($a[63]);
            $dp_liquido=trim($a[64]);
            $dp_essalud=trim($a[65]);
  
            if(strlen($nivel_n_id)==1){
              $nivel_n_id='0'.$nivel_n_id;
            }
  
            $mifecha = explode("/", $dp_fech_ini);
            $lafecha=$mifecha[2]."-".$mifecha[1]."-".$mifecha[0]; 
            $dp_fech_ini= $lafecha;
  
            $mifecha = explode("/", $dp_fech_term);
            $lafecha=$mifecha[2]."-".$mifecha[1]."-".$mifecha[0]; 
            $dp_fech_term= $lafecha;
  
            if($dp_fech_afi=='01/01/1900'){
              $dp_fech_afi= null;
            }else {
              $mifecha = explode("/", $dp_fech_afi);
              $lafecha=$mifecha[2]."-".$mifecha[1]."-".$mifecha[0]; 
              $dp_fech_afi= $lafecha;
            }
  
            if($dp_fech_dev=='01/01/1900'){
              $dp_fech_dev= null;
            }else {
              $mifecha = explode("/", $dp_fech_dev);
              $lafecha=$mifecha[2]."-".$mifecha[1]."-".$mifecha[0]; 
              $dp_fech_dev= $lafecha;
            }
  
            if($dp_fech_ini_lic=='01/01/1900'){
              $dp_fech_ini_lic= null;
            }else {
              $mifecha = explode("/", $dp_fech_ini_lic);
              $lafecha=$mifecha[2]."-".$mifecha[1]."-".$mifecha[0]; 
              $dp_fech_ini_lic= $lafecha;
            }
  
            if(strlen($dp_cuenta)==10) {
              $dp_cuenta="0".$dp_cuenta;
            }
  
            //INSERTAR PERSONAL
            $personal = Personal::firstOrCreate(
              ['p_id' => $p_id],
              ['p_id' => $p_id,
              'p_a_paterno' => $p_a_paterno,
              'p_a_materno' => $p_a_materno,
              'p_nombres' => $p_nombres,
              'sexo_p_sexo' => $sexo_p_sexo,
              'p_fech_nac' => $p_fech_nac,
              'p_tip_doc' => $p_tip_doc,
              'p_num_doc' => $p_num_doc,
              'nacionalidad_n_id' => $nacionalidad_n_id],
            );
  
             //INSERTAR DETALLE PLANILLA
            $detalle_planilla= new Detalleplanilla();
            $detalle_planilla->dp_cod_registro=$dp_cod_registro;
            $detalle_planilla->dp_cod_cargo = $dp_cod_cargo;
            $detalle_planilla->situacion_personal_sp_id = $situacion_personal_sp_id;
            $detalle_planilla->nec_nec_id = $nec_nec_id;
            $detalle_planilla->nivel_n_id = $nivel_n_id;
            $detalle_planilla->establecimiento_est_id = $establecimiento_est_id;
            $detalle_planilla->dp_plaza = $dp_plaza;
            $detalle_planilla->pd_dias_lab = $pd_dias_lab;
            $detalle_planilla->dp_fech_ini = $dp_fech_ini;
            $detalle_planilla->dp_fech_term = $dp_fech_term;
            $detalle_planilla->tipo_servidor_ts_id = $tipo_servidor_ts_id;
            $detalle_planilla->dp_nivel_mag = $dp_nivel_mag;
            $detalle_planilla->dp_nivel_magref = $dp_nivel_magref;
            $detalle_planilla->dp_categoria_rem = $dp_categoria_rem;
            $detalle_planilla->dp_jor_lab = $dp_jor_lab;
            $detalle_planilla->cargo_car_id = $cargo_car_id;
            $detalle_planilla->regimen_pension_rp_id = $regimen_pension_rp_id;
            $detalle_planilla->dp_seg_salud = $dp_seg_salud;
            $detalle_planilla->dp_num_segsalud = $dp_num_segsalud;
            $detalle_planilla->admin_pension_ap_id = $admin_pension_ap_id;
            $detalle_planilla->dp_cuspp = $dp_cuspp;
            $detalle_planilla->dp_fech_afi = $dp_fech_afi;
            $detalle_planilla->dp_fech_dev = $dp_fech_dev;
            $detalle_planilla->dp_tip_encarg = $dp_tip_encarg;
            $detalle_planilla->dp_tipo_plaza = $dp_tipo_plaza;
            $detalle_planilla->dp_dias_lic = $dp_dias_lic;
            $detalle_planilla->dp_fech_ini_lic = $dp_fech_ini_lic;
            $detalle_planilla->dp_cuenta = $dp_cuenta;
            $detalle_planilla->dp_leyenda_mensual = $dp_leyenda_mensual;
            $detalle_planilla->dp_leyenda_permanente = $dp_leyenda_permanente;
            $detalle_planilla->regimen_laboral_rl_id = $regimen_laboral_rl_id;
            $detalle_planilla->dp_horas_adicionales = $dp_horas_adicionales;
            $detalle_planilla->dp_cod_nexus = $dp_cod_nexus;
            $detalle_planilla->dp_bruto = $dp_bruto;
            $detalle_planilla->dp_afecto = $dp_afecto;
            $detalle_planilla->dp_desc = $dp_desc;
            $detalle_planilla->dp_liquido = $dp_liquido;
            $detalle_planilla->dp_essalud = $dp_essalud;
            $detalle_planilla->dp_noabono = 0;
            $detalle_planilla->planilla_pll_id = $id_planilla;
            $detalle_planilla->personal_p_id = $p_id;
            $detalle_planilla->tipo_planilla_tp_id = 4;
            $detalle_planilla->save();

            //Conteo de registros
            $c++;
  
          }
      
          //****FIN DE CARGA PLANILLA COMPLEMENTARIA****

        }

        $sumatorias_planilla = Detalleplanilla::select(DB::raw('sum(dp_bruto) as dp_bruto, sum(dp_desc) as dp_desc, sum(dp_liquido) as dp_liquido, sum(dp_essalud) as dp_essalud'))
          ->join('planilla','detalle_planilla.planilla_pll_id','=','planilla.pll_id')
          ->where('planilla_pll_id','=',$select_planilla->pll_id)
          ->get()->first();

        $actualizarplanilla= Planilla::findOrFail($id_planilla);
        $actualizarplanilla->pll_bruto = $sumatorias_planilla->dp_bruto;
        $actualizarplanilla->pll_desc = $sumatorias_planilla->dp_desc;
        $actualizarplanilla->pll_liquido = $sumatorias_planilla->dp_liquido;
        $actualizarplanilla->pll_essalud = $sumatorias_planilla->dp_essalud;
        $actualizarplanilla->save();
  
        fclose($oa);

        $res = $c.' Registros Procesados';

        return response()->json([
            'res'=>$res,
            'totalbruto'=>$sumatorias_planilla->dp_bruto,
            'totaldescuentos'=>$sumatorias_planilla->dp_desc,
            'totalliquido'=>$sumatorias_planilla->dp_liquido,
            'totalessalud'=>$sumatorias_planilla->dp_essalud,
            'tipocarga' => $tipocarga,
            'status' => true,
            'message' => 'Copiado Satisfactoriamente',
        ], 200);

      } catch (\Throwable $th) {
        return response()->json([
          'status' => false,
          'message' => $th->getMessage()
      ], 500);
      }

      
    }
  
    public function searchNoabono(Request $request)
    {

      try {
        
        $num_doc=$request->num_doc;

        $select_planilla = Planilla::where('estado_planilla_ep_id','=',1)->first();
        $id_planilla = $select_planilla->pll_id;

        $personal= Personal::join('detalle_planilla','personal.p_id','detalle_planilla.personal_p_id')
        ->join('planilla','detalle_planilla.planilla_pll_id','planilla.pll_id')
        ->select('p_id','p_a_paterno','p_a_materno','p_nombres','p_num_doc','dp_id','dp_cod_cargo','cargo_car_id','dp_bruto','dp_afecto','dp_desc','dp_liquido','dp_essalud','dp_noabono','dp_motivo_na')
        ->where('pll_id','=',$id_planilla)
        ->where('p_num_doc','=',$num_doc)
        ->orderBy('p_a_paterno','asc')
        ->get();

        return response()->json([
          'status' => true,
          'message' => 'Reporte Satisfactorio',
          'personal' => $personal
        ], 200);

      } catch (\Throwable $th) {
        return response()->json([
          'status' => false,
          'message' => $th->getMessage()
      ], 500);
      }

    }

    public function addNoabono(Request $request) {

      try {

        $dp_id= $request->dp_id;
        $dp_motivo_na = $request->dp_motivo_na;
        $user = 'JULIO';//Auth::user()->name;

        $detalle_planilla=Detalleplanilla::findOrFail($dp_id);
        $detalle_planilla->dp_noabono=1;
        $detalle_planilla->dp_motivo_na=$dp_motivo_na;
        $detalle_planilla->dp_usuario_na=$user;
        $detalle_planilla->save();

        Planillaconceptos::where('detalle_planilla_dp_id', $dp_id)
          ->update(['pcon_noabono' => 1]);
        
          return response()->json([
            'status' => true,
            'message' => 'Registro correcto',
          ], 200);

      } catch (\Throwable $th) {
        return response()->json([
          'status' => false,
          'message' => $th->getMessage()
        ], 500);
      }

    }

    public function removeNoabono(Request $request) {

      try {

        $dp_id= $request->dp_id;

        $detalle_planilla=Detalleplanilla::findOrFail($dp_id);
        $detalle_planilla->dp_noabono=0;
        $detalle_planilla->dp_motivo_na='';
        $detalle_planilla->dp_usuario_na='';
        $detalle_planilla->save();

        Planillaconceptos::where('detalle_planilla_dp_id', $dp_id)
          ->update(['pcon_noabono' => 0]);
        
          return response()->json([
            'status' => true,
            'message' => 'Registro Retirado',
          ], 200);

      } catch (\Throwable $th) {
        return response()->json([
          'status' => false,
          'message' => $th->getMessage()
        ], 500);
      }

    }

    public function periodosNoabono(Request $request) {

      try {

        //SELECT pll_periodo FROM planilla WHERE estado_planilla_ep_id=2 ORDER BY pll_periodo DESC

        $dataPeriodosnoabono = Planilla::select('pll_id','pll_periodo')->orderBy('pll_periodo','desc')->get();

        return response()->json([
          'status' => true,
          'dataPeriodosnoabono' => $dataPeriodosnoabono,
          'message' => 'ok'
        ], 200);

      } catch (\Throwable $th) {

        return response()->json([
          'status' => false,
          'message' => $th->getMessage()
        ], 500);

      }
      
    }

    public function mostrarNoabono(Request $request)
    {

      try {
        
        $pll_id=$request->pll_id;

        $personal= Personal::join('detalle_planilla','personal.p_id','detalle_planilla.personal_p_id')
        ->join('planilla','detalle_planilla.planilla_pll_id','planilla.pll_id')
        ->select('p_id','p_a_paterno','p_a_materno','p_nombres','p_num_doc','dp_id','dp_cod_cargo','cargo_car_id','dp_bruto','dp_afecto','dp_desc','dp_liquido','dp_essalud','dp_noabono','dp_motivo_na')
        ->where('pll_id','=',$pll_id)
        ->where('dp_noabono','=',1)
        ->orderBy('p_a_paterno','asc')
        ->paginate(20);

        return [
          'pagination' =>[
              'total'         => $personal->total(),
              'current_page'  => $personal->currentPage(),
              'per_page'      => $personal->perpage(),
              'last_page'     => $personal->lastPage(),
              'from'          => $personal->firstItem(),
              'to'            => $personal->lastItem(),
          ],
          'personal' => $personal
        ];

        // return response()->json([
        //   'status' => true,
        //   'message' => 'Reporte Satisfactorio',
        //   'personal' => $personal,
        // ], 200);

      } catch (\Throwable $th) {
        return response()->json([
          'status' => false,
          'message' => $th->getMessage()
      ], 500);
      }

    }


    public function noAbonopdf(Request $request) {

      try {

        $pll_id=$request->pll_id;

        //

        $planilla = Planilla::where('pll_id',$pll_id)->first();

        //Data de los conceptos existentes
        $sqlDataconceptos="SELECT con_id, con_concepto, con_nombre, SUM(pcon_monto) AS monto
        FROM planilla_conceptos INNER JOIN detalle_planilla on planilla_conceptos.detalle_planilla_dp_id=detalle_planilla.dp_id
        INNER JOIN planilla on detalle_planilla.planilla_pll_id=planilla.pll_id
        INNER JOIN conceptos on planilla_conceptos.conceptos_con_id=conceptos.con_id
        WHERE dp_id IN (SELECT dp_id FROM detalle_planilla WHERE dp_noabono=true)
        AND tipo_conceptos_tc_id=2 AND pll_id='".$pll_id."' GROUP BY con_id;";
 
        $dataConceptos= DB::select($sqlDataconceptos);

        //Relacion No abono
        $noAbono = Detalleplanilla::join('personal','detalle_planilla.personal_p_id','personal.p_id')
        ->join('planilla','detalle_planilla.planilla_pll_id','planilla.pll_id')
        ->join('nivel','detalle_planilla.nivel_n_id','nivel.n_id')
        ->join('tipo_servidor','detalle_planilla.tipo_servidor_ts_id','tipo_servidor.ts_id')
        ->where('dp_noabono', '=', true)
        ->where('pll_id', '=', $pll_id)
        ->with('res_conceptos')
        ->get();

        //DATA REMUNERACION LIQUIDO
        $sqlDataremuneracion = "SELECT cl_clasificador,sf_secuencia_funcional, COALESCE(SUM(CASE tipo_conceptos_tc_id WHEN 1 THEN pcon_monto END),0) m_bruto,
        COALESCE(SUM(CASE tipo_conceptos_tc_id WHEN 2 THEN pcon_monto END),0) descuentos,
        COALESCE(SUM(CASE tipo_conceptos_tc_id WHEN 1 THEN pcon_monto END),0) - COALESCE(SUM(CASE tipo_conceptos_tc_id WHEN 2 THEN pcon_monto END),0) as resta
        from planilla_conceptos inner join conceptos on planilla_conceptos.conceptos_con_id=conceptos.con_id
        inner join detalle_planilla on planilla_conceptos.detalle_planilla_dp_id=detalle_planilla.dp_id
        inner join planilla on detalle_planilla.planilla_pll_id=planilla.pll_id
        inner join clasificador on planilla_conceptos.clasificador_cl_id=clasificador.cl_id
        inner join secuencia_funcional on planilla_conceptos.secuencia_funcional_sf_id=secuencia_funcional.sf_id
        where pll_id='".$pll_id."' and dp_noabono=true and (tipo_conceptos_tc_id=1 or tipo_conceptos_tc_id=2)
        group by cl_clasificador,sf_secuencia_funcional";

        $dataRemuneracion = DB::select($sqlDataremuneracion);

        //DATA AFP
        $sqlDataafp = "select rp_admin_pension,cl_clasificador,sf_secuencia_funcional, SUM(pcon_monto) monto
        from planilla_conceptos inner join conceptos on planilla_conceptos.conceptos_con_id=conceptos.con_id
        inner join detalle_planilla on planilla_conceptos.detalle_planilla_dp_id=detalle_planilla.dp_id
        inner join admin_pension on detalle_planilla.admin_pension_ap_id=admin_pension.ap_id
        inner join planilla on detalle_planilla.planilla_pll_id=planilla.pll_id
        inner join clasificador on planilla_conceptos.clasificador_cl_id=clasificador.cl_id
        inner join secuencia_funcional on planilla_conceptos.secuencia_funcional_sf_id=secuencia_funcional.sf_id
        where pll_id='".$pll_id."' and pcon_noabono=true and con_concepto='-0113'
        group by rp_admin_pension,cl_clasificador,sf_secuencia_funcional";

        $dataAfp = DB::select($sqlDataafp);

        //DATA ONP
        $SQLDataonp = "select cl_clasificador,sf_secuencia_funcional,sum(pcon_monto) monto
        from planilla_conceptos inner join conceptos on planilla_conceptos.conceptos_con_id=conceptos.con_id
        inner join detalle_planilla on planilla_conceptos.detalle_planilla_dp_id=detalle_planilla.dp_id
        inner join planilla on detalle_planilla.planilla_pll_id=planilla.pll_id
        inner join clasificador on planilla_conceptos.clasificador_cl_id=clasificador.cl_id
        inner join secuencia_funcional on planilla_conceptos.secuencia_funcional_sf_id=secuencia_funcional.sf_id
        where pll_id='".$pll_id."' and pcon_noabono=true and con_id=53
        group by cl_clasificador,sf_secuencia_funcional";

        $dataOnp = DB::select($SQLDataonp);

        //DATA ESSALUD
        $SQLDataessalud = "select cl_clasificador,sf_secuencia_funcional,sum(pcon_monto) monto
        from planilla_conceptos inner join conceptos on planilla_conceptos.conceptos_con_id=conceptos.con_id
        inner join detalle_planilla on planilla_conceptos.detalle_planilla_dp_id=detalle_planilla.dp_id
        inner join planilla on detalle_planilla.planilla_pll_id=planilla.pll_id
        inner join clasificador on planilla_conceptos.clasificador_cl_id=clasificador.cl_id
        inner join secuencia_funcional on planilla_conceptos.secuencia_funcional_sf_id=secuencia_funcional.sf_id
        where pll_id='".$pll_id."' and pcon_noabono=true and con_concepto='essalu'
        group by cl_clasificador,sf_secuencia_funcional";

        $dataEssalud = DB::select($SQLDataessalud);

        $SQLDataquintacat = "select cl_clasificador,sf_secuencia_funcional,sum(pcon_monto) monto
        from planilla_conceptos inner join conceptos on planilla_conceptos.conceptos_con_id=conceptos.con_id
        inner join detalle_planilla on planilla_conceptos.detalle_planilla_dp_id=detalle_planilla.dp_id
        inner join planilla on detalle_planilla.planilla_pll_id=planilla.pll_id
        inner join clasificador on planilla_conceptos.clasificador_cl_id=clasificador.cl_id
        inner join secuencia_funcional on planilla_conceptos.secuencia_funcional_sf_id=secuencia_funcional.sf_id
        where pll_id='".$pll_id."' and pcon_noabono=true and con_concepto='-0121'
        group by cl_clasificador,sf_secuencia_funcional";

        $dataQuintacat = DB::select($SQLDataquintacat);

        return response()->json([
          'status' => true,
          'message' => 'Reporte Satisfactorio',
          'dataConceptos' => $dataConceptos,
          'noAbono' => $noAbono,
          'dataRemuneracion' => $dataRemuneracion,
          'dataAfp' => $dataAfp,
          'dataEssalud' => $dataEssalud,
          'dataOnp' => $dataOnp,
          'planilla' => $planilla,
          'dataQuintacat' => $dataQuintacat
        ], 200);

      } catch (\Throwable $th) {
        return response()->json([
          'status' => false,
          'message' => $th->getMessage()
      ], 500);
      }
      
    }

    public function searchAutorizacion(Request $request)
    {

      try {
        
        $num_doc=$request->num_doc;

        $personal= Personal::join('detalle_planilla','personal.p_id','detalle_planilla.personal_p_id')
        ->join('planilla','detalle_planilla.planilla_pll_id','planilla.pll_id')
        ->select('p_id','p_a_paterno','p_a_materno','p_nombres','p_num_doc','dp_id','dp_cod_cargo','cargo_car_id','dp_bruto','dp_afecto','dp_desc','dp_liquido','dp_essalud','dp_noabono','dp_motivo_na')
        ->where('p_num_doc','=',$num_doc)
        ->orderBy('p_a_paterno','asc')
        ->get();

        return response()->json([
          'status' => true,
          'message' => 'Reporte Satisfactorio',
          'personal' => $personal
        ], 200);

      } catch (\Throwable $th) {
        return response()->json([
          'status' => false,
          'message' => $th->getMessage()
      ], 500);
      }

    }

    public function autorizacionPdf(Request $request){

      try {

        $num_doc=$request->numDocumento;

         $dataConceptos=Planillaconceptos::join('conceptos','planilla_conceptos.conceptos_con_id','conceptos.con_id')
            ->join('detalle_planilla','planilla_conceptos.detalle_planilla_dp_id','detalle_planilla.dp_id')
            ->join('personal','detalle_planilla.personal_p_id','personal.p_id')
            ->join('planilla','detalle_planilla.planilla_pll_id','planilla.pll_id')
            ->select('con_id','con_concepto','con_nombre', DB::raw('sum(pcon_monto) as monto'))
            ->where('p_num_doc', '=', $num_doc)
            ->where('dp_noabono', '=', 0)
            ->where('tipo_conceptos_tc_id', '=',2)
            ->groupBy('con_id','con_concepto','con_nombre')
            ->get();


        $dataAutorizacion=Detalleplanilla::join('personal','detalle_planilla.personal_p_id','personal.p_id')
          ->join('planilla','detalle_planilla.planilla_pll_id','planilla.pll_id')
          ->join('nivel','detalle_planilla.nivel_n_id','nivel.n_id')
          ->join('regimen_pension','detalle_planilla.regimen_pension_rp_id','regimen_pension.rp_id')
          ->join('tipo_servidor','detalle_planilla.tipo_servidor_ts_id','tipo_servidor.ts_id')
          ->where('p_num_doc', '=', $num_doc)
          ->with('res_conceptos')
          ->where('dp_noabono', '=', false)
          ->where('tipo_planilla_tp_id','=',1)
          ->orderBy('pll_periodo','desc')
          ->take(3)->get();

        return response()->json([
          'status' => true,
          'message' => 'Reporte Satisfactorio',
          'dataautorizacion' => $dataAutorizacion,
          'dataconceptos' => $dataConceptos
        ], 200);

      } catch (\Throwable $th) {
        return response()->json([
          'status' => false,
          'message' => $th->getMessage()
      ], 500);
      }

  }

  public function afpExcelnominal(Request $request){

    try {

      $num_id = $request->num_id;

      $personal=Detalleplanilla::join('personal','detalle_planilla.personal_p_id','personal.p_id')
        ->join('planilla','detalle_planilla.planilla_pll_id','planilla.pll_id')
        ->join('regimen_pension','detalle_planilla.regimen_pension_rp_id','regimen_pension.rp_id')
        ->join('admin_pension','detalle_planilla.admin_pension_ap_id','admin_pension.ap_id')
        ->where('pll_id', '=',$num_id)
        ->where('regimen_pension_rp_id','=',3)
        ->get();

        $numeracionrem=12;
        $numeracion = 1;
        $data=[];
        
        $row = [];
        $row[0] = 'N°';
        $row[1] = 'ESTADO';
        $row[2] = 'TIP_DOC';
        $row[3] = 'DNI';
        $row[4] = 'COD_MODULAR';
        $row[5] = 'COD_CARGO';
        $row[6] = 'AP_PATERNO';
        $row[7] = 'AP_MATERNO';
        $row[8] = 'NOMBRES';
        $row[9] = 'FECHA_INGRESO';
        $row[10] = 'FECHA_TERMINO';
        $row[11] = 'ADMIN_PENSION';
        $row[12] = 'COD_SIS_PEN';
        $row[13] = 'SIS_PENSION';
        $row[14] = 'CUSPP';
        $row[15] = 'SIS_PEN_RES';
        $row[16] = 'MONTO_AFECTO';
        $row[17] = 'CLASIFICADOR';
        $row[18] = 'META';
        $row[19] = 'CONCEPTO';
        $row[20] = 'NOM_CONCEPTO';
        $row[21] = 'MONTO AFP';

        $data[]=$row;


            foreach ($personal as $persona){

                $row = [];
                $row[0] = $numeracion;
                $row[1] = $persona->situacion_personal_sp_id;
                $row[2] = $persona->p_tip_doc;
                $row[3] = $persona->p_num_doc;
                $row[4] = $persona->p_id;
                $row[5] = $persona->dp_cod_cargo;
                $row[6] = $persona->p_a_paterno;
                $row[7] = $persona->p_a_materno;
                $row[8] = $persona->p_nombres;
                $row[9] = date("d/m/Y", strtotime($persona->dp_fech_ini));
                $row[10] = date("d/m/Y", strtotime($persona->dp_fech_term));
                $row[11] = $persona->rp_admin_pension;
                $row[12] = $persona->rp_id;
                $row[13] = $persona->rp_regimen_pension;
                $row[14] = $persona->dp_cuspp;
                $row[15] = $persona->ap_group;
                $row[16] = $persona->dp_afecto;


                $reportConceptos=Planillaconceptos::join('conceptos','planilla_conceptos.conceptos_con_id','conceptos.con_id')
                ->join('detalle_planilla','planilla_conceptos.detalle_planilla_dp_id','detalle_planilla.dp_id')
                ->join('clasificador','planilla_conceptos.clasificador_cl_id','clasificador.cl_id')
                ->join('secuencia_funcional','planilla_conceptos.secuencia_funcional_sf_id','secuencia_funcional.sf_id')
                ->where('conceptos_con_id','=',72)
                ->where('detalle_planilla_dp_id','=',$persona->dp_id)
                ->get();

                $montoafp = 0.00;
                $clasificador = '';
                $meta = '';
                $concepto = '';
                $nomconcepto = '';

                foreach($reportConceptos as $resconceptosimprimir){

                  $montoafp = $resconceptosimprimir->pcon_monto;
                  $clasificador = $resconceptosimprimir->cl_clasificador;
                  $meta = $resconceptosimprimir->sf_secuencia_funcional;
                  $concepto = $resconceptosimprimir->con_concepto;
                  $nomconcepto = $resconceptosimprimir->con_nombre;

                }

                $row[17] = $clasificador;
                $row[18] = $meta;
                $row[19] = $concepto;
                $row[20] = $nomconcepto;
                $row[21] = $montoafp;

                $data[]=$row;
                $numeracion += 1;
            }

       $arrayData = $data;

      return response()->json([
        'status' => true,
        'message' => 'Reporte Satisfactorio',
        'arraydata' => $arrayData
      ], 200);

    } catch (\Throwable $th) {
      return response()->json([
        'status' => false,
        'message' => $th->getMessage()
    ], 500);
    }

    


}

public function pdtExcel(Request $request){

  try {

    $num_id = $request->num_id;


    $personal=Detalleplanilla::select('p_num_doc')
      ->join('personal','detalle_planilla.personal_p_id','personal.p_id')
      ->join('planilla','detalle_planilla.planilla_pll_id','planilla.pll_id')
      ->where('pll_id', '=',$num_id)
      ->distinct()
      ->get();

      $numeracionrem=12;
      $numeracion = 1;
      $data=[];
      
      $row = [];
      $row[0] = 'N°';
      $row[1] = 'NUM_DOC';
      $row[2] = 'CODIGO_MODULAR';
      $row[3] = 'COD_CARGO';
      $row[4] = 'SITUACION';
      $row[5] = 'AP_PATERNO';
      $row[6] = 'AP_MATERNO';
      $row[7] = 'NOMBRES';
      $row[8] = 'SIS_PENSION';
      $row[9] = 'DIAS_LAB';
      $row[10] = 'ADMIN_PENSION';
      $row[11] = 'FECHA_INGRESO';
      $row[12] = 'FECHA_TERMINO';
      $row[13] = 'SUMA_CONCEPTOS';
      $row[14] = 'MONTO_AFECTO';
      $row[15] = 'DIFERENCIA';
      $row[16] = 'IPPS';
      $row[17] = 'SNP';
      $row[18] = 'QUINTA CAT';
      $row[19] = 'ESSALUD';
      $row[20] = 'TARDANZAS';
      $row[21] = 'INASISTENCIAS';
      $row[22] = 'AGUINALDO';
      $row[23] = 'OBSERVACION';

      $data[]=$row;

      $numeracionrem=12;
      $numeracion = 1;


      foreach ($personal as $persona){

        $registrosPersonal=Detalleplanilla::join('personal','detalle_planilla.personal_p_id','personal.p_id')
          ->join('planilla','detalle_planilla.planilla_pll_id','planilla.pll_id')
          ->where('pll_id', '=',$num_id)
          ->where('p_num_doc','=',$persona->p_num_doc)
          ->get();

          $p_num_doc = '';
          $p_id = '';
          $dp_cod_cargo ='';
          $situacion_personal_sp_id = '';
          $p_a_paterno = '';
          $p_a_materno = '';
          $p_nombres = '';
          $regimen_pension_rp_id = '';
          $pd_dias_lab = '';
          $admin_pension_ap_id = '';
          $dp_fech_ini = '';
          $dp_fech_term = '';
          $montoAfecto = 0.00;

          $mensajeSistemaPension='';

          foreach($registrosPersonal as $registropersonal) {

            if($p_num_doc===''){
              $p_num_doc = $registropersonal->p_num_doc;
              $p_id = $registropersonal->p_id;
              $dp_cod_cargo =$registropersonal->dp_cod_cargo;
              $situacion_personal_sp_id = $registropersonal->situacion_personal_sp_id;
              $p_a_paterno = $registropersonal->p_a_paterno;
              $p_a_materno = $registropersonal->p_a_materno;
              $p_nombres = $registropersonal->p_nombres;
              $regimen_pension_rp_id = $registropersonal->regimen_pension_rp_id;
              $pd_dias_lab = $registropersonal->pd_dias_lab;
              $admin_pension_ap_id = $registropersonal->admin_pension_ap_id;
              $dp_fech_ini = $registropersonal->dp_fech_ini;
              $dp_fech_term = $registropersonal->dp_fech_term;
            }else {
              //--VALIDAR ESTADO
              if($registropersonal->situacion_personal_sp_id===4){
                if($situacion_personal_sp_id<>4) {
                  $p_num_doc = $registropersonal->p_num_doc;
                  $p_id = $registropersonal->p_id;
                  $dp_cod_cargo =$registropersonal->dp_cod_cargo;
                  $situacion_personal_sp_id = $registropersonal->situacion_personal_sp_id;
                  $p_a_paterno = $registropersonal->p_a_paterno;
                  $p_a_materno = $registropersonal->p_a_materno;
                  $p_nombres = $registropersonal->p_nombres;
                  $regimen_pension_rp_id = $registropersonal->regimen_pension_rp_id;
                  $pd_dias_lab = $registropersonal->pd_dias_lab;
                  $admin_pension_ap_id = $registropersonal->admin_pension_ap_id;
                  $dp_fech_ini = $registropersonal->dp_fech_ini;
                  $dp_fech_term = $registropersonal->dp_fech_term;
                }
                if($situacion_personal_sp_id===4) {
                  if(strtotime($registropersonal->dp_fech_ini)<strtotime($dp_fech_ini)){
                    $p_num_doc = $registropersonal->p_num_doc;
                    $p_id = $registropersonal->p_id;
                    $dp_cod_cargo =$registropersonal->dp_cod_cargo;
                    $situacion_personal_sp_id = $registropersonal->situacion_personal_sp_id;
                    $p_a_paterno = $registropersonal->p_a_paterno;
                    $p_a_materno = $registropersonal->p_a_materno;
                    $p_nombres = $registropersonal->p_nombres;
                    $regimen_pension_rp_id = $registropersonal->regimen_pension_rp_id;
                    $pd_dias_lab = $registropersonal->pd_dias_lab;
                    $admin_pension_ap_id = $registropersonal->admin_pension_ap_id;
                    $dp_fech_ini = $registropersonal->dp_fech_ini;
                    $dp_fech_term = $registropersonal->dp_fech_term;
                  }
                }
              }
            }

            if($regimen_pension_rp_id<>$registropersonal->regimen_pension_rp_id){
              $mensajeSistemaPension='No concuerda su Administracion de Pension';
            }

            $montoAfecto = $montoAfecto + $registropersonal->dp_afecto;

          }

          $row = [];
          $row[0] = $numeracion;
          $row[1] = $p_num_doc;
          $row[2] = $p_id;
          $row[3] = $dp_cod_cargo	;
          $row[4] = $situacion_personal_sp_id;
          $row[5] = $p_a_paterno;
          $row[6] = $p_a_materno;
          $row[7] = $p_nombres;
          $row[8] = $regimen_pension_rp_id;
          $row[9] = $pd_dias_lab;
          $row[10] = $admin_pension_ap_id;
          $row[11] =  date("d/m/Y", strtotime($dp_fech_ini));
          $row[12] =  date("d/m/Y", strtotime($dp_fech_term));

          $reportConceptos=Planillaconceptos::join('conceptos','planilla_conceptos.conceptos_con_id','conceptos.con_id')
          ->join('detalle_planilla','planilla_conceptos.detalle_planilla_dp_id','detalle_planilla.dp_id')
          ->join('planilla','detalle_planilla.planilla_pll_id','planilla.pll_id')
          ->join('personal','detalle_planilla.personal_p_id','personal.p_id')
          ->where('pll_id', '=',$num_id)
          ->where('p_num_doc','=',$persona->p_num_doc)
          ->get();

          $sumaconceptos = 0.00;
          $sumaipps = 0.00;
          $sumasnp = 0.00;
          $sumaquintacat = 0.00;
          $sumaessalud = 0.00;
          $sumatardanza = 0.00;
          $sumainasistencia = 0.00;
          $sumaaguinaldo = 0.00;

          foreach($reportConceptos as $resconceptosimprimir){

            if($resconceptosimprimir->tipo_conceptos_tc_id==1 && $resconceptosimprimir->conceptos_con_id <> 17 && $resconceptosimprimir->conceptos_con_id <> 49 && $resconceptosimprimir->conceptos_con_id <> 107 && $resconceptosimprimir->conceptos_con_id <> 51){
              $sumaconceptos = $sumaconceptos + $resconceptosimprimir->pcon_monto;
            }

            if($resconceptosimprimir->conceptos_con_id=="59" ){
              $sumaipps = $sumaipps + $resconceptosimprimir->pcon_monto;
            }

            if($resconceptosimprimir->conceptos_con_id=="53" ){
              $sumasnp = $sumasnp + $resconceptosimprimir->pcon_monto;
            }

            if($resconceptosimprimir->conceptos_con_id=="76" ){
              $sumaquintacat = $sumaquintacat + $resconceptosimprimir->pcon_monto;
            }

            if($resconceptosimprimir->conceptos_con_id=="94" ){
              $sumaessalud = $sumaessalud + $resconceptosimprimir->pcon_monto;
            }

            if($resconceptosimprimir->conceptos_con_id=="66" ){
              $sumatardanza = $sumatardanza + $resconceptosimprimir->pcon_monto;
            }

            if($resconceptosimprimir->conceptos_con_id=="73" ){
              $sumainasistencia = $sumainasistencia + $resconceptosimprimir->pcon_monto;
            }
            
            if($resconceptosimprimir->conceptos_con_id=="51" ){
              $sumaaguinaldo = $sumaaguinaldo + $resconceptosimprimir->pcon_monto;
            }

          }


          $row[13] = $sumaconceptos;
          $row[14] = $montoAfecto;
          $row[15] = $sumaconceptos - $montoAfecto;
          $row[16] = $sumaipps;
          $row[17] = $sumasnp;
          $row[18] = $sumaquintacat;
          $row[19] = $sumaessalud;
          $row[20] = $sumatardanza;
          $row[21] = $sumainasistencia;
          $row[22] = $sumaaguinaldo;
          $row[23] = $mensajeSistemaPension;

        $data[]=$row;
        $numeracion += 1;
      }

    $arrayData = $data;

    return response()->json([
      'status' => true,
      'message' => 'Reporte Satisfactorio',
      'arraydata' => $arrayData
    ], 200);

  } catch (\Throwable $th) {
    return response()->json([
      'status' => false,
      'message' => $th->getMessage()
  ], 500);
  }

  


}
  
    
}
