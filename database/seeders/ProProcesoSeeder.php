<?php

namespace Database\Seeders;

use App\Models\ProProceso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProProcesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sqlEloquent = ProProceso::create([
            'pro_prefijo' => 'PRO',
            'pro_nombre' => 'Proceso'
        ]);

        $sqlPuro = "INSERT INTO pro_proceso (pro_prefijo,pro_nombre)
                    VALUES ('ING','Ingenieria'),
                    ('ELEC','Electrica'),
                    ('MECA','Mecanica'),
                    ('CIV','Civil'),
                    ('SIS','Sistemas'),
                    ('ADM','Administracion'),
                    ('CONT','Contabilidad'),
                    ('FIS','Fisica'),
                    ('MAT','Matematicas')
                    ";
       DB::unprepared($sqlPuro);

    }
}
