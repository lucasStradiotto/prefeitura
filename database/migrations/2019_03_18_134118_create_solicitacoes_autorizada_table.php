<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitacoesAutorizadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacoes_autorizadas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome_solicitante')->nullable();
            $table->string('documento_solicitante')->nullable();
            $table->string('endereco')->nullable();
            $table->string('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->string('municipio')->nullable();
            $table->string('cep')->nullable();
            $table->string('objeto')->nullable();
            $table->string('quantidade')->nullable();
            $table->string('enquadramento')->nullable();
            $table->string('exigencias')->nullable();
            $table->string('observacoes_gerais')->nullable();
            $table->string('data_expedicao')->nullable();
            $table->string('hora_expedicao')->nullable();
            $table->string('autenticacao')->nullable();
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
        Schema::dropIfExists('solicitacoes_autorizadas');
    }
}
