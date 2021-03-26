<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaInscricaoQuestionario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_inscricao_questionario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inscricao_atividade_id');
            $table->string('pergunta', 500);
            $table->boolean('resposta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa_inscricao_questionario');
    }
}
