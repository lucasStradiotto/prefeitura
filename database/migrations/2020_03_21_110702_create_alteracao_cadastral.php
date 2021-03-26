<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlteracaoCadastral extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alteracao_cadastral', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inscricao_id');
            $table->integer('agente_id');
            $table->dateTime('data_hora');
            $table->string('nome_fantasia');
            $table->string('email');
            $table->integer('numero_funcionarios');
            $table->boolean('estabelecido');
            $table->boolean('recusa_assinatura');
            $table->string('assinatura');
            $table->timestamps();
        });

        Schema::create('alteracao_cadastral_telefone', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alteracao_cadastral_id');
            $table->string('ddd');
            $table->string('telefone');
            $table->string('descricao');
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
        Schema::dropIfExists('alteracao_cadastral');

        Schema::dropIfExists('alteracao_cadastral_telefone');
    }
}
