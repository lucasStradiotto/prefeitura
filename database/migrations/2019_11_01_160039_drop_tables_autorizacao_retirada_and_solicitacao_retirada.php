<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTablesAutorizacaoRetiradaAndSolicitacaoRetirada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('solicitacao_retirada');
        Schema::dropIfExists('autorizacao_retirada');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('solicitacao_retirada', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bairro');
            $table->string('rua');
            $table->string('numero');
            $table->string('nome_solicitante');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE solicitacao_retirada ADD imagem MEDIUMBLOB");

        Schema::create('autorizacao_retirada', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('retirada_id');
            $table->boolean('aprovado');
            $table->timestamps();
        });
    }
}
