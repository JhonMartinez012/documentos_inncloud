<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_documento', function (Blueprint $table) {
            $table->bigIncrements('doc_id');
            $table->string('doc_nombre',60);
            $table->string('doc_codigo')->unique();
            $table->text('doc_contenido');
            //llave foranea de la tabla tip_tipo_doc
            $table->unsignedBigInteger('doc_id_tipo');
            $table->foreign('doc_id_tipo')->references('tip_id')->on('tip_tipo_doc');

            //llave foranea de la tabla pro_proceso
            $table->unsignedBigInteger('doc_id_proceso');
            $table->foreign('doc_id_proceso')->references('pro_id')->on('pro_proceso');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_documento');
    }
};
