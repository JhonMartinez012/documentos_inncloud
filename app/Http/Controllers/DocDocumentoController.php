<?php

namespace App\Http\Controllers;

use App\Models\DocDocumento;
use App\Models\ProProceso;
use App\Models\TipTipoDoc;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocDocumentoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function listarDocumentos()
    {
        $lisDocumentos = DocDocumento::get();
        if (!$lisDocumentos) {
            return response()->json([
                "status" => 404,
                "message" => "No se encontraron documentos"
            ]);
        }
        return response()->json([
            "status" => 200,
            "datos" => $lisDocumentos
        ]);
    }

    public function registrarDocumento(Request $request)
    {
        try {

            $validate = $request->validate([
                'doc_nombre' => 'string|unique:doc_documento',
                'doc_contenido' => 'string',
                'doc_id_tipo' => 'integer',
                'doc_id_proceso' => 'integer'
            ]);

            // Se llama la funcion que calcula el codigo
            $codigo = $this->calcularCodigo($request['doc_id_tipo'], $request['doc_id_proceso']);
            

            $registro = DocDocumento::create([
                'doc_nombre' => $request['doc_nombre'],
                'doc_codigo' => $codigo,
                'doc_contenido' => $request['doc_contenido'],
                'doc_id_tipo' => $request['doc_id_tipo'],
                'doc_id_proceso' => $request['doc_id_proceso']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }

        return response()->json([
            'status' => 201,
            'message' => 'Documento registrado correctamente',
            'data' => $registro
        ], 201);
    }

    public function editarDocumento($id, Request $request)
    {
        $validate = $request->validate([
            'doc_nombre' => 'string',
            'doc_contenido' => 'string',
            'doc_id_tipo' => 'integer',
            'doc_id_proceso' => 'integer'
        ]);
        
        $documento = DocDocumento::where('doc_id', $id)->exists();

        if (!$documento) {
            return response()->json([
                'message' => 'No se encontro el documento',
            ], 404);
        }

        $documento = DocDocumento::where('doc_id', $id)->first();

        if (($documento->doc_id_tipo !== $request->doc_id_tipo)
            || ($documento->doc_id_proceso != $request->doc_id_proceso)
        ) {
            $codigo = $this->calcularCodigo($request->doc_id_tipo, $request->doc_id_proceso);

            $documento->update([
                'doc_codigo' => $codigo 
            ]);
        } 

        $documento->update([
            'doc_nombre' => $request->doc_nombre,
            'doc_contenido' => $request->doc_contenido,
            'doc_id_tipo' => $request->doc_id_tipo,
            'doc_id_proceso' => $request->doc_id_proceso        
        ]);

        return response()->json([
            'message' => 'Documento actualizado correctamente',
            'data' => $documento
        ], 200);
    }

    public function eliminarDocumento($id)
    {
        $documento = DocDocumento::where('doc_id', $id)->exists();

        if (!$documento) {
            return response()->json([
                'message' => 'No se encontro el documento',
            ], 404);
        }

        $documento = DocDocumento::where('doc_id', $id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Documento eliminado correctamente',
        ], 200);
    }

    public function calcularCodigo($nDoc_id_tipo, $nDoc_id_proceso)
    {
        //Seleccionamos el prefijo de el tipo
        $sPrefijo = '';
        $sqlPrefijo = TipTipoDoc::where('tip_id', $nDoc_id_tipo)->get();

        if (!$sqlPrefijo) {
            return response()->json([
                'message' => 'No se encontro el tipo de documento',
            ], 404);
        }
        $sPrefijo = $sqlPrefijo[0]->tip_prefijo;
        $sPrefijo = strtoupper($sPrefijo);

        // Se busca el prefijo de el documento
        $sPrefijoProceso = '';
        $sqlPrefijoProceso = ProProceso::where('pro_id', $nDoc_id_proceso)->get();
        if (!$sqlPrefijoProceso) {
            return response()->json([
                'message' => 'No se encontro el proceso',
            ], 404);
        }
        $sPrefijoProceso = $sqlPrefijoProceso[0]->pro_prefijo;
        $sPrefijoProceso = strtoupper($sPrefijoProceso);


        // formamos el codigo unico TIP_PREFIJO-PRO_PREFIJO-<CONSECUTIVO>, para ello seleccionamos el ultimo id creado 
        // y le sumamos 1
        $selectIdCodigo = DB::select('select MAX(doc_id) as maxConsecutivo from doc_documento');

        if (!$selectIdCodigo) {
            $nIdCodigo = 1;
        }
        $nIdCodigo = $selectIdCodigo[0]->maxConsecutivo + 1;

        return $sPrefijo . '-' . $sPrefijoProceso . '-' . $nIdCodigo;
    }
}
