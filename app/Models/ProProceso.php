<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProProceso extends Model
{
    use HasFactory;

    protected $table = "pro_proceso";
    protected $fillable = [
        'pro_prefijo',
        'pro_nombre',
    ];

    public function docDocuments()
    {
        return $this->hasMany(DocDocumento::class, 'doc_id_proceso');
    }
}
