<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocDocumentoController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'procesos'
], function ($router) {
    Route::get('listar', [ProProcesoController::class, 'listarProcesos']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'tipo-documento'
], function ($router) {
    Route::get('listar', [TipTipoDocController::class, 'listarTipos']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'documentos'
], function ($router) {
    Route::get('listar', [DocDocumentoController::class, 'listarDocumentos']);
    Route::post('registrar', [DocDocumentoController::class, 'registrarDocumento']);
    Route::put('editar/{id}', [DocDocumentoController::class, 'editarDocumento']);
    Route::delete('eliminar/{id}', [DocDocumentoController::class, 'eliminarDocumento']);
});
