<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSolicitacoesImagens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacoes_imagens', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('solicitacao_id')->nullable();
            $table->string('tipo_solicitacao')->nullable();
            $table->string('nome')->nullable();
            $table->string('projeto_storage')->nullable();
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
        Schema::dropIfExists('solicitacoes_imagens');
    }
}
