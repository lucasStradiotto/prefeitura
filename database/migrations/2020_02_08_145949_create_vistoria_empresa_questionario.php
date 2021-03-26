<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVistoriaEmpresaQuestionario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vistoria_empresa_questionario', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vistoria_id')->nullable();
            $table->string('pergunta', 500)->nullable();
            $table->boolean('resposta')->nullable();
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
        Schema::dropIfExists('vistoria_empresa_questionario');
    }
}
