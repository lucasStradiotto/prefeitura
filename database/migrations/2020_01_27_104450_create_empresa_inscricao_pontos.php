<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaInscricaoPontos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_inscricao_pontos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inscricao_id');
            $table->string('descricao')->nullable();
            $table->string('tipo')->nullable();
            $table->string('especie')->nullable();
            $table->string('logradouro')->nullable();
            $table->string('bairro')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa_inscricao_pontos');
    }
}
