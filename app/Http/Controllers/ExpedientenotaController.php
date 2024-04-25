<?php

namespace App\Http\Controllers;

use App\Models\Expedientenota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpedientenotaController extends Controller
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
                $this->procesarExpedientenota($registro);
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

    private function procesarExpedientenota($data) {
        // Datos personales
        $en_anio_eje = ltrim($data[0]);
        $en_expediente = ltrim($data[2]);
        $en_fase=ltrim($data[4]);
        $en_secuencia=ltrim($data[5]);
        $en_secuencia_nota=ltrim($data[6]);
        $en_nota=mb_convert_encoding(ltrim($data[7]),'UTF-8');
        $en_estado_envio=ltrim($data[9]);

        // Insertar o actualizar datos utilizando el model binding de Laravel
        Expedientenota::updateOrCreate(
            ['en_anio_eje' => $en_anio_eje,'en_expediente' => $en_expediente],
            [
                'en_anio_eje' => $en_anio_eje,
                'en_expediente' => $en_expediente,
                'en_fase' => $en_fase,
                'en_secuencia' => $en_secuencia,
                'en_secuencia_nota' => $en_secuencia_nota,
                'en_nota' => $en_nota,
                'en_estado_envio' => $en_estado_envio
            ]
            );
    }

}
