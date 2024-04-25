<?php

namespace App\Http\Controllers;

use App\Models\Padronpersona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PadronpersonaController extends Controller
{

    public function import(Request $request)
      {

        try {

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
              $this->procesarPadronpersona($registro);
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

      private function procesarPadronpersona($data) {
        // Datos personales
        $pp_tip_doc = ltrim($data[0]);
        $pp_num_doc = ltrim($data[1]);
        $pp_a_paterno = mb_convert_encoding(ltrim($data[2]), 'UTF-8');
        $pp_a_materno = mb_convert_encoding(ltrim($data[3]), 'UTF-8');
        $pp_nombres = mb_convert_encoding(ltrim($data[4]), 'UTF-8');
        $pp_sexo = ltrim($data[5]);
        $pp_fech_nac = ltrim($data[6]);

        $mifecha = explode("/", $pp_fech_nac);
        $lafecha = "{$mifecha[2]}-{$mifecha[0]}-{$mifecha[1]}";
        $pp_fech_nac_fin = $lafecha;

        // Insertar o actualizar datos utilizando el model binding de Laravel
        Padronpersona::updateOrCreate(
            ['pp_num_doc' => $pp_num_doc],
            [
                'pp_tip_doc' => $pp_tip_doc,
                'pp_num_doc' => $pp_num_doc,
                'pp_a_paterno' => $pp_a_paterno,
                'pp_a_materno' => $pp_a_materno,
                'pp_nombres' => $pp_nombres,
                'pp_sexo' => $pp_sexo,
                'pp_fech_nac' => $pp_fech_nac_fin
            ]
            );
    }

}
