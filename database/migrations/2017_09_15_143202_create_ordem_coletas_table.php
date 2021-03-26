<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdemColetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_coletas', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome_solicitante');
            $table->string('cnpj')->nullable();
            $table->string('cpf')->nullable();
            $table->dateTime('data');
            $table->dateTime('data_entrega')->nullable();
            $table->dateTime('data_retirada')->nullable();
            $table->integer('valor');
            $table->string('inscricao_estadual')->nullable();
            $table->string('rg')->nullable();
            $table->string('telefone');
            $table->string('numero_ctr');

            $table->integer('material_predominante_id')->unsigned();
            $table->foreign('material_predominante_id')
                ->references('id')
                ->on('tipo_entulhos');

            $table->integer('endereco_cobranca_id')->unsigned();
//            $table->foreign('endereco_cobranca_id')
//                ->references('id')
//                ->on('ruas');

            $table->integer('bairro_cobranca_id')->unsigned();
//            $table->foreign('bairro_cobranca_id')
//                ->references('id')
//                ->on('bairros');

            $table->integer('numero_casa_cobranca_id')->unsigned();
//            $table->foreign('numero_casa_cobranca_id')
//                ->references('numero')
//                ->on('setores_bairros_ruas_lotes');

            $table->integer('numero_obra')->unsigned();
//            $table->foreign('numero_obra')
//                ->references('numero')
//                ->on('setores_bairros_ruas_lotes');

            $table->integer('endereco_obra_id')->unsigned();
//            $table->foreign('endereco_obra_id')
//                ->references('id')
//                ->on('ruas');

            $table->integer('bairro_obra_id')->unsigned();
//            $table->foreign('bairro_obra_id')
//                ->references('id')
//                ->on('bairros');

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
        Schema::dropIfExists('ordem_coletas');
    }
}
