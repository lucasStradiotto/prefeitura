<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentoAnexadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_anexados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('caminho');

            $table->integer('protocolo_id')->unsigned();
            $table->foreign('protocolo_id')
                ->references('id')
                ->on('protocolos');

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
        Schema::dropIfExists('documento_anexados');
    }
}
