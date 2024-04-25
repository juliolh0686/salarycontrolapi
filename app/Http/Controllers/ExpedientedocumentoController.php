<?php

namespace App\Http\Controllers;

use App\Models\Expedientedocumento;
use App\Models\Detalleexpedientedocumento;
use App\Models\Expedientenota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpedientedocumentoController extends Controller
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
                $this->procesarExpedientedocumento($registro);
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

    private function procesarExpedientedocumento($data) {

        $ed_anio_eje=ltrim($data[0]);
        $ed_expediente=ltrim($data[2]);
        $ed_secuencia=ltrim($data[5]);
        $ed_num_doc=ltrim($data[8]);
        $ed_descripcion=mb_convert_encoding(ltrim($data[11]),'UTF-8');

        $expediente_nota = Expedientenota::where('en_anio_eje', $ed_anio_eje)
            ->where('en_expediente', $ed_expediente)
            ->first();

        $idexpediente_nota = $expediente_nota->en_id;

         Expedientedocumento::updateOrCreate(
            ['ed_anio_eje' => $ed_anio_eje,'ed_expediente' => $ed_expediente,'ed_secuencia' => $ed_secuencia],
            [
                'ed_anio_eje' => $ed_anio_eje,
                'ed_expediente' => $ed_expediente,
                'ed_secuencia' => $ed_secuencia,
                'ed_num_doc' => $ed_num_doc,
                'ed_descripcion' => $ed_descripcion,
                'expediente_nota_en_id' => $idexpediente_nota
            ]
            );

         //detalle expediente documento
         $ded_anio_eje=ltrim($data[0]);
         $ded_expediente=ltrim($data[2]);
         $ded_fase=ltrim($data[4]);
         $ded_secuencia=ltrim($data[5]);
         $ded_cod_doc=ltrim($data[7]);
         $ded_num_doc=ltrim($data[8]);
         $ded_fech_doc=ltrim($data[10]);
         $ded_nombre=mb_convert_encoding(ltrim($data[11]),'UTF-8');
         $ded_monto=ltrim($data[16]);

         $mifecha = explode("/", $ded_fech_doc);
         $lafecha=$mifecha[2]."-".$mifecha[0]."-".$mifecha[1];
         $ded_fech_doc_fin= $lafecha;

         $expediente_documento = Expedientedocumento::where('ed_anio_eje', $ded_anio_eje)
         ->where('ed_expediente', $ded_expediente)
         ->where('ed_secuencia', $ded_secuencia)
         ->first();

        $idexpediente_documento = $expediente_documento->ed_id;

        // Insertar o actualizar datos utilizando el model binding de Laravel

        Detalleexpedientedocumento::firstOrCreate(
            ['ded_anio_eje' => $ded_anio_eje,'ded_expediente' => $ded_expediente,'ded_fase' => $ded_fase,'ded_secuencia' => $ded_secuencia],
            [
                'ded_anio_eje' => $ded_anio_eje,
                'ded_expediente' => $ded_expediente,
                'ded_fase' => $ded_fase,
                'ded_secuencia' => $ded_secuencia,
                'ded_cod_doc' => $ded_cod_doc,
                'ded_num_doc' => $ded_num_doc,
                'ded_fech_doc' => $ded_fech_doc_fin,
                'ded_nombre' => $ded_nombre,
                'ded_monto' => $ded_monto,
                'expediente_documento_ed_id' => $idexpediente_documento]);
    }


}
