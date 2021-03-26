<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEmpresaInscricoesV2Related extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('empresa_inscricoes', function (Blueprint $table) {
            $table->integer('inscricao_id')->nullable();
            $table->integer('contribuinte_id')->nullable();
            $table->integer('inscricao_atividade_id')->nullable();
            $table->integer('endereco_logradouro_id')->nullable();
            $table->integer('endereco_bairro_id')->nullable();
            $table->string('atividade_risco')->nullable();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('empresa_inscricoes', function (Blueprint $table) {
            $table->dropColumn(
                [
                    'inscricao_id', 
                    'contribuinte_id', 
                    'inscricao_atividade_id', 
                    'endereco_logradouro_id',
                    'endereco_bairro_id',
                    'atividade_risco'
                ]
            );
        });*/
    }
}
