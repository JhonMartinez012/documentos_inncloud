<?php

namespace App\Http\Controllers;

use App\Models\TipTipoDoc;
use Illuminate\Http\Request;

class TipTipoDocController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    //funcion para listar todos los tipos de documentos
    public function listarTipos(){
        $listTiposDoc = TipTipoDoc::get();
        if (!$listTiposDoc) {
            return response()->json([
                "status"=>404,
                "message"=>"No se encontraron tipos de documentos"
            ]);
        }
        return response()->json([
            "status"=>200,
            "datos"=>$listTiposDoc
        ]);
    }


}
