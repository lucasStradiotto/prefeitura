<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEspecificacoesSolicitacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especificacoes_solicitacao', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('solicitacao_id');
            $table->string('nome_popular');
            $table->string('nome_cientifico');
            $table->string('origem');
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
        Schema::dropIfExists('especificacoes_solicitacao');
    }
}
