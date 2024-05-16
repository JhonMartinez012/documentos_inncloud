<?php

use App\Http\Controllers\ProProcesoController;
use App\Http\Controllers\TipTipoDocController;
use App\Models\ProProceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'procesos'
], function ($router) {
    Route::get('listar', ProProcesoController::class, 'listarProcesos');
});

Route::group([
    'prefix' => 'tipo-procesos'
], function ($router) {
    Route::get('listar', TipTipoDocController::class , 'listarTipos');
});

Route::group([
    'prefix' => 'documentos'
], function ($router) {
    Route::get('listar', TipTipoDocController::class,'listarDocumentos');
    Route::post('registrar', TipTipoDocController::class,'registrarDocumento');
    Route::put('editar/{id}', TipTipoDocController::class,'editarDocumento');
    Route::delete('eliminar/{id}', TipTipoDocController::class,'eliminarDocumento');
});


