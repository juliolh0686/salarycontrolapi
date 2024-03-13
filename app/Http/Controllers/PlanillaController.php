<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planilla;

class PlanillaController extends Controller
{
    public function listarPlanillas() {

        try {
    
            $planilla= Planilla::orderBy('pll_id','DESC')->paginate(14);
    
            return [
              'pagination' =>[
                  'total'         => $planilla->total(),
                  'current_page'  => $planilla->currentPage(),
                  'per_page'      => $planilla->perpage(),
                  'last_page'     => $planilla->lastPage(),
                  'from'          => $planilla->firstItem(),
                  'to'            => $planilla->lastItem(),
              ],
              'planilla' => $planilla
            ];
    
          } catch (\Throwable $th) {
            return response()->json([
              'status' => false,
              'message' => $th->getMessage()
          ], 500);
          }

    }
}
