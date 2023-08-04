<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetallePlanillaController;
use App\Http\Controllers\PlanillaconceptosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'createUser']);
Route::post('login', [AuthController::class, 'loginUser']);
Route::post('detalleplanilla/import149',[DetallePlanillaController::class,'import149'])->name('detalleplanilla.import149');
Route::post('/planillaconceptos/import002rem',[PlanillaconceptosController::class,'import002rem'])->name('planillaconceptos.import002rem');

Route::middleware('auth:sanctum')->get('/logout', [AuthController::class, 'logout']);
