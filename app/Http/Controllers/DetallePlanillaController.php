<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personal;
use App\Models\Planilla;
use App\Models\Detalleplanilla;

class DetallePlanillaController extends Controller
{
    public function import149(Request $request)
    {

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
        $select_planilla = Planilla::where('estado_planilla_cod_estado_planilla','=','01')->get()->first();
        $id_planilla = $select_planilla->cod_planilla;

        while($a = fgetcsv($oa,1000, $cardelimitador)){
          //--DATOS PERSONALES--//
          $p_id=ltrim($a[1]);
          $p_a_paterno=trim($a[5]);
          $p_a_materno=trim($a[6]);
          $p_nombres=trim($a[7]);
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
          $dp_plaza=trim($a[18]);
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
          $dp_num_segsalud=trim($a[35]);
          $admin_pension_ap_id=trim($a[36]);
          $dp_cuspp=trim($a[37]);
          $dp_fech_afi=trim($a[38]);
          $dp_fech_dev=trim($a[39]);
          $dp_tip_encarg=trim($a[40]);
          $dp_tipo_plaza=trim($a[43]);
          $dp_dias_lic=trim($a[44]);
          $dp_fech_ini_lic=trim($a[45]);
          $dp_cuenta=trim($a[54]);
          $dp_leyenda_mensual=trim($a[55]);
          $dp_leyenda_permanente=trim($a[56]);
          $regimen_laboral_rl_id=trim($a[58]);
          $dp_horas_adicionales= trim($a[57]);
          $dp_cod_nexus=trim($a[60]);
          $dp_bruto=trim($a[61]);
          $dp_afecto=trim($a[62]);
          $dp_desc=trim($a[63]);
          $dp_liquido=trim($a[64]);
          $dp_essalud=trim($a[65]);

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
          $detalle_planilla->dp_cuenta = '0'.$dp_cuenta;
          $detalle_planilla->dp_leyenda_mensual = $dp_leyenda_mensual;
          $detalle_planilla->dp_leyenda_permanente = $dp_cuenta;
          $detalle_planilla->regimen_laboral_rl_id = $regimen_laboral_rl_id;
          $detalle_planilla->dp_leyenda_permanente = $dp_cuenta;
          $detalle_planilla->dp_horas_adicionales = $dp_horas_adicionales;
          $detalle_planilla->dp_cod_nexus = $dp_cod_nexus;
          $detalle_planilla->dp_bruto = $dp_bruto;
          $detalle_planilla->dp_afecto = $dp_afecto;
          $detalle_planilla->dp_desc = $dp_desc;
          $detalle_planilla->dp_liquido = $dp_liquido;
          $detalle_planilla->dp_essalud = $dp_essalud;
          $detalle_planilla->dp_noabono = 0;
          $detalle_planilla->planilla_cod_planilla = $id_planilla;
          $detalle_planilla->personal_p_id = $p_id;
          $detalle_planilla->tipo_planilla_tp_id = 1;
          $detalle_planilla->save();

        }

        return response()->json([
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
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

  
    public function show(string $id)
    {
        //
    }

   
    public function edit(string $id)
    {
        //
    }

   
    public function update(Request $request, string $id)
    {
        //
    }

   
    public function destroy(string $id)
    {
        //
    }
}
