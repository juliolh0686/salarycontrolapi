<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetallePlanillaController;
use App\Http\Controllers\ExpedientedocumentoController;
use App\Http\Controllers\PlanillaconceptosController;
use App\Http\Controllers\PlanillaController;
use App\Http\Controllers\ConceptoController;
use App\Http\Controllers\PadronPersonaController;
use App\Http\Controllers\ExpedientenotaController;
use App\Http\Controllers\PlanillamcppController;

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

//IMPORTACION DE PLANILLA
Route::post('detalleplanilla/import149',[DetallePlanillaController::class,'import149'])->name('detalleplanilla.import149');
Route::post('/planillaconceptos/import002rem',[PlanillaconceptosController::class,'import002rem'])->name('planillaconceptos.import002rem');

//IMPORTACION SIAF
Route::post('expedientenota/import',[ExpedientenotaController::class,'import'])->name('expedientenota.import');
Route::post('expedientedocumento/import',[ExpedientedocumentoController::class,'import'])->name('expedientedocumento.import');
Route::post('planillamcpp/import',[PlanillamcppController::class,'import'])->name('planillamcpp.import');
Route::post('planillamcpp/listardepositos',[PlanillamcppController::class,'listardepositos'])->name('planillamcpp.listardepositos');

//NO ABONOS
Route::post('/noabonos/searchnoabono',[DetallePlanillaController::class,'searchNoabono'])->name('noabonos.searchnoabono');
Route::post('/noabonos/addnoabono',[DetallePlanillaController::class,'addNoabono'])->name('noabonos.addnoabono');
Route::post('/noabonos/removenoabono',[DetallePlanillaController::class,'removeNoabono'])->name('noabonos.removenoabono');
Route::post('/noabonos/periodosnoabono',[DetallePlanillaController::class,'periodosNoabono'])->name('noabonos.periodosnoabono');
Route::post('/noabonos/mostrarnoabono',[DetallePlanillaController::class,'mostrarNoabono'])->name('noabonos.mostrarnoabono');
Route::post('/noabonos/noabonopdf',[DetallePlanillaController::class,'noAbonopdf'])->name('noabonos.noabonopdf');

//AUTORIZACION DE DESCUENTOS
Route::post('/planilla/autorizacion',[DetallePlanillaController::class,'searchAutorizacion'])->name('planilla.autorizacion');
Route::post('/planilla/autorizacionPDF',[DetallePlanillaController::class,'autorizacionPdf'])->name('planilla.autorizacionPDF');

//Prueba salir
Route::post('/planilla/afpExcelnominal',[DetallePlanillaController::class,'afpExcelnominal'])->name('planilla.afpExcelnominal');
Route::post('/planilla/afpExcel',[DetallePlanillaController::class,'afpExcel'])->name('planilla.afpExcel');
Route::post('/planilla/pdtexcel',[DetallePlanillaController::class,'pdtExcel'])->name('planilla.pdtexcel');

//Reportes PDT
Route::post('planilla/fileide',[DetallePlanillaController::class,'fileide'])->name('planilla.fileide');
Route::post('planilla/filetra',[DetallePlanillaController::class,'filetra'])->name('planilla.filetra');
Route::post('planilla/fileest',[DetallePlanillaController::class,'fileest'])->name('planilla.fileest');
Route::post('planilla/fileedu',[DetallePlanillaController::class,'fileedu'])->name('planilla.fileedu');
Route::post('planilla/fileper',[DetallePlanillaController::class,'fileper'])->name('planilla.fileper');

//Reportes
Route::post('planilla/optionconceptos',[ConceptoController::class,'optionConceptos'])->name('planilla.optionconceptos');
Route::post('/planilla/conceptosExcelnominal',[ConceptoController::class,'conceptosExcelnominal'])->name('planilla.conceptosExcelnominal');

//Reporte de 100 en 100
Route::post('planilla/reporteexcel100',[DetallePlanillaController::class,'reporteExcel100'])->name('planilla.reporteExcel100');

//planila controller
Route::post('planilla/listplanillas',[PlanillaController::class,'listarPlanillas'])->name('planilla.listplanillas');

Route::middleware('auth:sanctum')->get('/logout', [AuthController::class, 'logout']);
