<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Concepto;
use App\Models\Detalleplanilla;

class ConceptoController extends Controller
{
    public function optionConceptos(Request $request){
        try {
            $dataConceptos = Concepto::select('con_id','con_concepto','con_nombre')->orderBy('con_concepto','asc')->get();
    
            return response()->json([
              'status' => true,
              'dataConceptos' => $dataConceptos,
              'message' => 'ok'
            ], 200);
    
          } catch (\Throwable $th) {
    
            return response()->json([
              'status' => false,
              'message' => $th->getMessage()
            ], 500);
    
          }
    }

    public function conceptosExcelnominal(Request $request) {
        try {

            $id_planilla = $request->id_planilla;
            $id_concepto = $request->id_concepto;
        
            $data = [];
        
            $row = [];
            $row[0] = 'T_PLANILLA';
            $row[1] = 'NUM_DOC';
            $row[2] = 'COD_MODULAR';
            $row[3] = 'COD_CARGO';
            $row[4] = 'A_PATERNO';
            $row[5] = 'A_MATERNO';
            $row[6] = 'NOMBRES';
            $row[7] = 'CLASIFICADOR';
            $row[8] = 'SEC_FUN';
            $row[9] = 'CONCEPTO';
            $row[10] = 'NOM_CONCEPTO';
            $row[11] = 'MONTO';
        
            $sqlDataConceptos = "
            SELECT
                tp_descripcion,
                p_num_doc,
                p_id,
                dp_cod_cargo,
                p_a_paterno,
                p_a_materno,
                p_nombres,
                cl_clasificador,
                sf_secuencia_funcional,
                con_concepto,
                con_nombre,
                pcon_monto
            FROM
                planilla_conceptos 
                INNER JOIN conceptos ON planilla_conceptos.conceptos_con_id=conceptos.con_id
                INNER JOIN detalle_planilla ON planilla_conceptos.detalle_planilla_dp_id=detalle_planilla.dp_id
                INNER JOIN personal ON detalle_planilla.personal_p_id=personal.p_id
                INNER JOIN planilla ON detalle_planilla.planilla_pll_id=planilla.pll_id
                INNER JOIN tipo_planilla ON detalle_planilla.tipo_planilla_tp_id=tipo_planilla.tp_id
                INNER JOIN clasificador ON planilla_conceptos.clasificador_cl_id=clasificador.cl_id
                INNER JOIN secuencia_funcional ON planilla_conceptos.secuencia_funcional_sf_id=secuencia_funcional.sf_id
                INNER JOIN regimen_pension ON detalle_planilla.regimen_pension_rp_id=regimen_pension.rp_id
                INNER JOIN admin_pension ON detalle_planilla.admin_pension_ap_id=admin_pension.ap_id
            WHERE
                conceptos_con_id=".$id_concepto."
                AND pll_id ='".$id_planilla."';
            ";
        
            $dataConceptos = DB::select($sqlDataConceptos);

            $numRegistros = count($dataConceptos);

            if($numRegistros == 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'No Existen Registros',
                  ], 200);
            }
        
            $data[]=$row;
        
            foreach($dataConceptos as $conceptos){
        
              $row = [];
              $row[0] = $conceptos->tp_descripcion;
              $row[1] = $conceptos->p_num_doc;
              $row[2] = $conceptos->p_id;
              $row[3] = $conceptos->dp_cod_cargo;
              $row[4] = $conceptos->p_a_paterno;
              $row[5] = $conceptos->p_a_materno;
              $row[6] = $conceptos->p_nombres;
              $row[7] = $conceptos->cl_clasificador;
              $row[8] = $conceptos->sf_secuencia_funcional;
              $row[9] = $conceptos->con_concepto;
              $row[10] = $conceptos->con_nombre;
              $row[11] = $conceptos->pcon_monto;
            
              $data[]=$row;
        
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
