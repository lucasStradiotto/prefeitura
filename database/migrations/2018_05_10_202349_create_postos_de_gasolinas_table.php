<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostosDeGasolinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postos_de_gasolinas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome')->nullable();
            $table->string('nome_fantasia')->nullable();
            $table->string('cep')->nullable();
            $table->string('endereco')->nullable();
            $table->string('numero')->nullable();
            $table->integer('cidade_id')->nullable();
            $table->string('bairro')->nullable();
            $table->string('completemento')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('inscricao_estadual')->nullable();
            $table->string('inscricao_municipal')->nullable();
            $table->string('telefone')->nullable();
            $table->string('telefone_dois')->nullable();
            $table->string('contato')->nullable();
            $table->string('email')->nullable();
            $table->string('caixa_postal')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('postos_de_gasolinas');
    }
}
