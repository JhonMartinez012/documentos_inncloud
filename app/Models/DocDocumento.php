<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocDocumento extends Model
{
    use HasFactory;

    protected $table = "doc_documento";
    protected $fillable = [
        'doc_nombre',
        'doc_codigo',
        'doc_contenido'
    ];

    public function proProceso()
    {
        return $this->belongsTo(ProProceso::class, 'doc_id_proceso');
    }

    public function tipTipoDoc()
    {
        return $this->belongsTo(tipTipoDoc::class, 'doc_id_tipo');
    }
    
}
