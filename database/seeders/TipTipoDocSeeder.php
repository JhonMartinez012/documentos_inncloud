<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipTipoDocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Se crean los tipos de documentos que van a ser estaticos
        $sql = "INSERT INTO tip_tipo_doc (tip_nombre ,tip_prefijo)
                    VALUES ('Formato','FORM'),
                    ('Manual','MAN'),
                    ('Politica', 'POLI'),
                    ('Reglamento', 'REG'),
                    ('Instructivo', 'INS'),
                    ('Plan','PLAN'),
                    ('Proyecto', 'PROYE'),
                    ('Informe', 'INFO'),
                    ('Acta', 'ACT'),
                    ('Contrato', 'CONT'),
                    ('Certificado','CERTI'),
                    ('Licencia', 'LIC'),
                    ('Permiso', 'PERMI'),
                    ('Patente','PATENT')
                    ";
        DB::unprepared($sql);

    }
}
