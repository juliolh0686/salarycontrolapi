<?php

namespace App\Http\Controllers;

use App\Models\Planillamcpp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Padronpersona;
use App\Models\Expedientedocumento;

class PlanillamcppController extends Controller
{

    public function import(Request $request)
    {
        try {

            //Rescatar el nombre
            $nom_archivo = $request->filename;
            $num_doc_siaf = basename($nom_archivo, ".csv");


            // Guardar el archivo en storage/app/public
            $path = $request->file('file')->store('public');

            // Obtener el nombre del archivo
            $path_nombre = basename($path);

            // Abrir el archivo
            $carpeta = storage_path('app/public/');
            $file = fopen($carpeta . $path_nombre, 'r');

            if (!$file) {
              throw new \Exception("No se pudo abrir el archivo.");
            }

            $limitador = ',';
            $contador = 0;

            // Recorrer todas las filas
            while ($registro = fgetcsv($file, 1000, $limitador)) {
                // Procesar datos
                $this->procesarPlanillasiaf($registro,$num_doc_siaf);
                $contador++;
            }

            // Cerrar el archivo
            fclose($file);

            // Eliminar el archivo después del procesamiento
            Storage::delete($path);

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

    private function procesarPlanillasiaf($data,$num_doc_siaf) {

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

        $expediente_documento = Expedientedocumento::where('ed_num_doc', $num_doc_siaf)->first();
        $idexpediente_documento = $expediente_documento->ed_id;

        $expediente_documento_ed_id= $idexpediente_documento;

        // // Insertar o actualizar datos utilizando el model binding de Laravel

        Planillamcpp::firstOrCreate(
            ['padron_personas_pp_id' => $padron_personas_pp_id,'expediente_documento_ed_id' => $idexpediente_documento],
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
                'expediente_documento_ed_id' => $expediente_documento_ed_id
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
            'datos_personales' => $datos_personales
        ];
    }

}
