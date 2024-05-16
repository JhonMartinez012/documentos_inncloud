<?php

namespace App\Http\Controllers;

use App\Models\ProProceso;
use Illuminate\Http\Request;

class ProProcesoController extends Controller
{
    //
    public function listarProcesos(){
        try {
            $listProcesos = ProProceso::all();
            if (count($listProcesos)>0){
                return response()->json([
                    "status"=>200,
                    "datos"=>$listProcesos
                ]);
            }
            return response()->json([
                "status"=>404,
                "message"=>"No se encontraron procesos"
            ]);
        } catch( \Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
