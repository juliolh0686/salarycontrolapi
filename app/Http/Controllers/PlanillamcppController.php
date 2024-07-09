<?php

namespace App\Http\Controllers;

use App\Models\Planillamcpp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Padronpersona;
use App\Models\Expedientedocumento;
use App\Imports\PlanillaDataImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PlanillamcppController extends Controller
{

    public function import(Request $request)
    {
        try {

            //Rescatar el nombre
            $nom_archivo = $request->filename;
            $num_doc_siaf = basename($nom_archivo, ".xlsx");

            $contador = 0;

            $import = new PlanillaDataImport;
            $data = Excel::toCollection($import,request()->file('file'));

            $datos = $data->first();

            //Sacar el codigo expediente documento
            $expediente_documento = Expedientedocumento::where('ed_num_doc', $num_doc_siaf)->first();
            $idexpediente_documento = $expediente_documento->ed_id;

            $expediente_documento_ed_id=$idexpediente_documento;

            //return $expediente_documento_ed_id;


            //Recorrer las filas a insertar
            foreach ($datos->skip(1) as $fila) {
                $this->procesarPlanillasiaf($fila,$expediente_documento_ed_id);
                $contador++;
            }

            return response()->json([
                'status' => true,
                'message' => 'Reporte Satisfactorio',
                'numero' => $contador
              ], 200);


          } catch (\Throwable $th) {
            return response()->json([
              'status' => false,
              'message' => $th->getMessage()
            ], 500);
          }
    }

    private function procesarPlanillasiaf($data,$expediente_documento) {

        $pp_tip_doc=trim($data[7]);
        $pp_num_doc=trim($data[8]);
        $pp_nombre=mb_convert_encoding(trim($data[9]),'UTF-8');

        Padronpersona::updateOrCreate(
        ['pp_num_doc' => $pp_num_doc],
        [
            'pp_tip_doc' => $pp_tip_doc,
            'pp_num_doc' => $pp_num_doc,
            'pp_nombre' => $pp_nombre
        ]
        );

         //Planilla MCPP
        $pm_anio=trim($data[1]);
        $pm_mes=trim($data[2]);
        $pm_tipoplanilla=trim($data[3]);
        $pm_claseplanilla=trim($data[4]);
        $pm_correlativo=str_pad(trim($data[5]),4, "0", STR_PAD_LEFT);
        $pm_ticket=trim($data[6]);
        $pm_montoneto=trim($data[12]);
        $pm_banco=trim($data[13]);
        $pm_cuenta=trim($data[15]);

        $padron_personas = Padronpersona::where('pp_num_doc', $pp_num_doc)->first();
        $idpadron_persona = $padron_personas->pp_id;

        $padron_personas_pp_id= $idpadron_persona;

        // // Insertar o actualizar datos utilizando el model binding de Laravel

        Planillamcpp::firstOrCreate(
            ['padron_personas_pp_id' => $padron_personas_pp_id,'expediente_documento_ed_id' => $expediente_documento],
            [
                'pm_anio' => $pm_anio,
                'pm_mes' => $pm_mes,
                'pm_tipoplanilla' => $pm_tipoplanilla,
                'pm_claseplanilla' => $pm_claseplanilla,
                'pm_correlativo' => $pm_correlativo,
                'pm_ticket' => $pm_ticket,
                'pm_montoneto' => $pm_montoneto,
                'pm_banco' => $pm_banco,
                'pm_cuenta' => $pm_cuenta,
                'padron_personas_pp_id' => $padron_personas_pp_id,
                'expediente_documento_ed_id' => $expediente_documento
            ]
            );
    }

    public function listardepositos(Request $request)
    {

            $pp_num_doc= $request->pp_num_doc;

            $listado_personal=Planillamcpp::join('padron_personas','planillamcpp.padron_personas_pp_id','padron_personas.pp_id')
            ->join('expediente_documento','planillamcpp.expediente_documento_ed_id','expediente_documento.ed_id')
            ->with('detalledoc')
            ->where('pp_num_doc','=',$pp_num_doc)
            ->orderBy('pm_anio', 'desc')
            ->orderBy('ed_expediente','desc')
            ->paginate(10);

            $datos_personales=Padronpersona::where('pp_num_doc','=',$pp_num_doc)->first();

            $newDate = DB::table('planillamcpp')->select('updated_at')->max('updated_at');
            $fecha_actualizado = date('d-m-Y', strtotime($newDate));



        return [
            'pagination' =>[
                'total'         => $listado_personal->total(),
                'current_page'  => $listado_personal->currentPage(),
                'per_page'      => $listado_personal->perpage(),
                'last_page'     => $listado_personal->lastPage(),
                'from'          => $listado_personal->firstItem(),
                'to'            => $listado_personal->lastItem(),
            ],
            'listado_personal' => $listado_personal,
            'datos_personales' => $datos_personales,
            'fecha_actualizado' => $fecha_actualizado
        ];
    }

}
