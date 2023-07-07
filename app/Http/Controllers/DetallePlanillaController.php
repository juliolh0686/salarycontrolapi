<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personal;

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

        while($a = fgetcsv($oa,1000, $cardelimitador)){
          //--DATOS PERSONALES--//
          $codigo_modular=ltrim($a[1]);
          $a_paterno=trim($a[5]);
          $a_materno=trim($a[6]);
          $nombres=trim($a[7]);
          $p_sexo=trim($a[8]);
          $p_fech_nac=trim($a[9]);
          $p_tip_doc=trim($a[10]);
          $dni=trim($a[11]);
          $nacionalidad_n_id=trim($a[12]);

          $mifecha = explode("/", $p_fech_nac);
          $lafecha=$mifecha[2]."-".$mifecha[1]."-".$mifecha[0]; 
          $p_fech_nac= $lafecha;

          //INSERTAR PERSONAL
          $personal = Personal::firstOrCreate(
            ['p_cod_mod' => $codigo_modular],
            ['p_cod_mod' => $codigo_modular,
            'p_a_paterno' => $a_paterno,
            'p_a_materno' => $a_materno,
            'p_nombres' => $nombres,
            'sexo_p_sexo' => $p_sexo,
            'p_fech_nac' => $p_fech_nac,
            'p_tip_doc' => $p_tip_doc,
            'p_num_doc' => $dni,
            'nacionalidad_n_id' => $nacionalidad_n_id],
          );

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
