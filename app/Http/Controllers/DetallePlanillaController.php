<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetallePlanillaController extends Controller
{
    public function import149(Request $request)
    {

        $tipoarchivo=$request->file;

       // $path = $request->file('file')->store('public');

        return response()->json([
            'status' => false,
            'message' => 'hola',
            'tipo'=> $tipoarchivo
        ], 500);
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
