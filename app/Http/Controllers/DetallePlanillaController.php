<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Personal;
use App\Models\Planilla;
use App\Models\Detalleplanilla;
use App\Models\Planillaconceptos;
use Illuminate\Support\Facades\Auth;

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

        $dataPeriodosnoabono = Planilla::select('pll_id','pll_periodo')->where('estado_planilla_ep_id',2)->orderBy('pll_periodo','desc')->get();

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


    public function noAbonopdf(Request $request) {

      try {

        $pll_id=$request->pll_id;

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

        return response()->json([
          'status' => true,
          'message' => 'Reporte Satisfactorio',
          'dataConceptos' => $dataConceptos,
          'noAbono' => $noAbono
        ], 200);

      } catch (\Throwable $th) {
        return response()->json([
          'status' => false,
          'message' => $th->getMessage()
      ], 500);
      }
      
    }
    
}
