<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planilla;
use App\Models\Detalleplanilla;
use App\Models\Concepto;
use App\Models\Planillaconceptos;

class PlanillaconceptosController extends Controller
{
  public function import002rem(Request $request)
  {

    $tipo_planilla= $request->tipocarga;

    try {
        //recibir el archivo y guardarlo en la carpeta storage/app/public
      $path = $request->file('file')->store('public');

      //Hallamos el nombre del archivo
      $path_array = explode('/',$path);
      $path_nombre = $path_array[1];

      //direccion de la carpeta donde se gusrda el archivo
      $carpeta = public_path().'/storage/';

      //Seleccionar la planilla activa
      $select_planilla = Planilla::where('estado_planilla_ep_id','=',1)->get()->first();
      $id_planilla = $select_planilla->pll_id;

      //Abrir el archivo txt
      $file = fopen($carpeta.$path_nombre,'r') or exit("Error abriendo el archivo!");

      //asignar el fichero a una cadena
      $datos = fread($file,filesize($carpeta.$path_nombre));
      $datos= preg_replace('[\n]','',$datos);
      $datos = mb_convert_encoding($datos,"UTF-8","ISO-8859-1");

      if($tipo_planilla==3) {
        $datos = preg_replace("[--------------------------------------------------------------------------------------------------------------------------------------------------------]","|",$datos);
      }else {
        $datos = preg_replace("[------------------------------------------------------------------------------------------------------------------------------------------------------------]","|",$datos);
      }

      $lineas = explode('|',$datos);
      $longitud = count($lineas);

      $conteo = 0;

      $conceptos = Concepto::get();
      $var_clasificador=0;
      $var_clasificador_essalud=0;
      $var_sec_fun=0;
      $conteo = 0;

      //Recorro los elementos
      for($registros=0;$registros<$longitud-1;$registros++){

        if($tipo_planilla==3) {
          $pos = strpos($lineas[$registros],'PLANILLA UNICA DE BENEFICIARIOS');
        }else {
          $pos = strpos($lineas[$registros],'PLANILLA UNICA DE REMUNERACIONES');
        }

        $pos2 = strpos($lineas[$registros],'NOMBRE DEL ESTABLECIMIENTO ');

        if($pos === false && $pos2 == false ) {


          if($tipo_planilla==3) {
            //EXTRAER CODIGO MODULAR
            $item_dni = strpos($lineas[$registros],"DNI");
            $dni = substr($lineas[$registros],$item_dni+5,10);
            $dni = preg_replace("/[\r\n|\n|\r]+/", "", $dni);
            $cod_mod = "10".$dni;
            //EXTRAER CODIGO CARGO
            $item_codcargo = strpos($lineas[$registros],"M IMPONIB");
            $cod_cargo = substr($lineas[$registros],$item_codcargo+21,7);
          }else {
            //EXTRAER CODIGO MODULAR
            $cod_mod = substr(ltrim($lineas[$registros]),0,10);
            //EXTRAER CODIGO CARGO
            $item_codcargo = strpos($lineas[$registros],"M IMPONIBLE :");
            $cod_cargo = substr($lineas[$registros],$item_codcargo+24,7);
          }

          $cod_mod = str_replace(' ','',$cod_mod);
          $cod_cargo = str_replace(' ','',$cod_cargo);

          $cod_registro = $cod_mod.$cod_cargo;

          $detalle_planilla = Detalleplanilla::join('planilla','detalle_planilla.planilla_pll_id','=','planilla.pll_id')
            ->join('tipo_servidor','detalle_planilla.tipo_servidor_ts_id','=','tipo_servidor.ts_id')
            ->join('nivel','detalle_planilla.nivel_n_id','=','nivel.n_id')
            ->where('dp_cod_registro','=',$cod_registro)
            ->where('planilla_pll_id','=',$id_planilla)
            ->where('tipo_planilla_tp_id','=',$tipo_planilla)
            ->first();



            if(!empty($detalle_planilla)) {

              $var_sec_fun=$detalle_planilla->sec_cod_sec_fun;
              $var_clasificador=$detalle_planilla->clasificador_cl_id;

              //VERIFICAR SI SON PRSONAL ADMINISTRATIVO
              if ($detalle_planilla->tipo_servidor_ts_id==3 || $detalle_planilla->tipo_servidor_ts_id==4 || $detalle_planilla->tipo_servidor_ts_id==5 || $detalle_planilla->tipo_servidor_ts_id==6 || $detalle_planilla->tipo_servidor_ts_id==9 || $detalle_planilla->tipo_servidor_ts_id==11){

                switch($detalle_planilla->nivel_n_id){
                  case '01':
                    $var_sec_fun=53;
                    break;
                  case '02':
                    $var_sec_fun=54;
                    break;
                  case '03':
                    $var_sec_fun=55;
                    break;
                  case '09':
                    $var_sec_fun=53;
                    break;
                  default:
                  $var_sec_fun = $var_sec_fun;
                }

              }

              //VERIFICAR SI SON PRITE
              if ($detalle_planilla->establecimiento_est_id=='0H048015' || $detalle_planilla->establecimiento_est_id=='0H118010'){
                $var_sec_fun=56;
              }

              //PROFESOR EDUCACION FISICA
              if($detalle_planilla->cargo_car_id=='5021') {
                $var_sec_fun=46;
              }

              //TECNICO DEPORTIVOS
              if ($detalle_planilla->cargo_car_id==5016){
                if($detalle_planilla->nivel_n_id=='02'){
                  $var_sec_fun = 47;
                }
                if($detalle_planilla->nivel_n_id=='03'){
                  $var_sec_fun = 52;
                }
              }

              //ESSALUD ADMINISTRATIVOS Y DOCENTES
              if ($detalle_planilla->tipo_servidor_ts_id==3 || $detalle_planilla->tipo_servidor_ts_id==4 || $detalle_planilla->tipo_servidor_ts_id==5 || $detalle_planilla->tipo_servidor_ts_id==6 || $detalle_planilla->tipo_servidor_ts_id==9 || $detalle_planilla->tipo_servidor_ts_id==11){
                $var_clasificador_essalud = 22;
              } else {
                $var_clasificador_essalud = 23;
              }

              //--INSERTAR APORTE A ESSALUD--//
              if($detalle_planilla->dp_essalud<>0) {
                $planilla_conceptos = new Planillaconceptos;
                $planilla_conceptos->pcon_monto = $detalle_planilla->dp_essalud;
                $planilla_conceptos->conceptos_con_id = 94;
                $planilla_conceptos->clasificador_cl_id = $var_clasificador_essalud;
                $planilla_conceptos->secuencia_funcional_sf_id = $var_sec_fun;
                $planilla_conceptos->detalle_planilla_dp_id = $detalle_planilla->dp_id;
                $planilla_conceptos->tipo_planilla_tp_id = $tipo_planilla;
                $planilla_conceptos->save();
              }

              //--RECORRER LOS CONCEPTOS Y BUSCAR EN EL REM 002---//
              foreach($conceptos as $itemsconceptos){

                $ub_concepto = strpos($lineas[$registros],$itemsconceptos->con_concepto);

                $var_sec_fun_con=$var_sec_fun;
                $var_clasificador_con=$var_clasificador;

                if($ub_concepto <> false){
                  $monto_concepto = str_replace(',','',substr($lineas[$registros],$ub_concepto+14,10));

                  if(is_numeric($monto_concepto)) {

                    //--MODIFICAR EL CLASIFICADOR BENEFICIOS SOCIALES
                    switch ($itemsconceptos->con_concepto) {
                      case '+023':
                        $var_clasificador_con=7;
                        break;
                      case '+022':
                        $var_clasificador_con=6;
                        break;
                      case '+028':
                        $var_clasificador_con=24;
                        break;
                      case '+029':
                        $var_clasificador_con=20;
                        break;
                      case '+032':
                        $var_clasificador_con=25;
                        break;
                      case '+206':
                        $var_clasificador_con=3;
                        break;
                      case '+244':
                        $var_clasificador_con=18;
                        break;
                      // case '+248':
                      //   $var_clasificador_con=26;
                      //   break;
                      // case '+249':
                      //   $var_clasificador_con=26;
                      //   break;
                      // case '+186':
                      //   $var_clasificador_con=26;
                      //   break;
                      case '+259':
                        $var_clasificador_con=3;
                        break;
                      case '+261':
                        $var_clasificador_con=3;
                        break;
                      case '+262':
                        $var_clasificador_con=4;
                        break;
                      case '+271':
                        $var_clasificador_con=3;
                        break;
                      case '+276':
                        $var_clasificador_con=24;
                        break;
                      case '+277':
                        $var_clasificador_con=20;
                        break;
                      case '+301':
                        $var_clasificador_con=25;
                        break;
                      case '+302':
                        $var_clasificador_con=20;
                        break;
                      case '+303':
                        $var_clasificador_con=24;
                        break;
                      default:
                        $var_clasificador_con=$var_clasificador_con;
                    }

                    if ($itemsconceptos->concepto=='+231'){
                      switch ($detalle_planilla->nivel_n_id) {
                        case '01':
                          $var_sec_fun_con=42;
                          break;
                        case '02':
                          $var_sec_fun_con=45;
                          break;
                        case '03':
                          $var_sec_fun_con=51;
                          break;
                        case '04':
                          $var_sec_fun_con=76;
                          break;
                        case '05':
                          $var_sec_fun_con=70;
                          break;
                        case '07':
                          $var_sec_fun_con=73;
                          break;
                        case '08':
                          $var_sec_fun_con=59;
                          break;
                        case '09':
                          $var_sec_fun_con=42;
                          break;
                        case '00':
                          $var_sec_fun_con=64;
                          break;
                        default:
                          $var_sec_fun_con=$var_sec_fun_con;
                      }
                    }

                    $planilla_conceptos = new Planillaconceptos;
                    $planilla_conceptos->pcon_monto = trim($monto_concepto);
                    $planilla_conceptos->conceptos_con_id = $itemsconceptos->con_id;
                    $planilla_conceptos->clasificador_cl_id = $var_clasificador_con;
                    $planilla_conceptos->secuencia_funcional_sf_id = $var_sec_fun_con;
                    $planilla_conceptos->detalle_planilla_dp_id = $detalle_planilla->dp_id;
                    $planilla_conceptos->tipo_planilla_tp_id = $tipo_planilla;
                    $planilla_conceptos->save();

                  }
                }

              }
            }
        }
        $conteo++;
      }

      fclose($file);

      $totalbruto = Planillaconceptos::join('conceptos','planilla_conceptos.conceptos_con_id','=','conceptos.con_id')
        ->join('detalle_planilla','detalle_planilla.dp_id','planilla_conceptos.detalle_planilla_dp_id')
        ->where('tipo_conceptos_tc_id','=',1)
        ->where('planilla_pll_id','=',$id_planilla)
        ->sum('pcon_monto');

      $totaldescuentos = Planillaconceptos::join('conceptos','planilla_conceptos.conceptos_con_id','=','conceptos.con_id')
        ->join('detalle_planilla','detalle_planilla.dp_id','planilla_conceptos.detalle_planilla_dp_id')
        ->where('tipo_conceptos_tc_id','=',2)
        ->where('planilla_pll_id','=',$id_planilla)
        ->sum('pcon_monto');

      $totalessalud = Planillaconceptos::join('conceptos','planilla_conceptos.conceptos_con_id','=','conceptos.con_id')
        ->join('detalle_planilla','detalle_planilla.dp_id','planilla_conceptos.detalle_planilla_dp_id')
        ->where('tipo_conceptos_tc_id','=',3)
        ->where('planilla_pll_id','=',$id_planilla)
        ->sum('pcon_monto');

      return response()->json([
        'res'=>$conteo,
        'totalbruto'=>round($totalbruto,2),
        'totaldescuentos'=>round($totaldescuentos,2),
        'totalliquido'=>round($totalbruto-$totaldescuentos,2),
        'totalessalud'=>round($totalessalud,2),
        'status' => true,
        'message' => 'Carga Satisfactoriamente',
    ], 200);

    } catch (\Throwable $th) {
        return response()->json([
          'status' => false,
          'message' => $th->getMessage()
        ], 500);
    }


  }
}
