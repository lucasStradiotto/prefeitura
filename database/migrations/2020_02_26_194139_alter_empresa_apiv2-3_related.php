<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEmpresaApiv23Related extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('empresas', function (Blueprint $table) {
            $table->string('contabilidade')->nullable();
            $table->string('porte')->nullable();
            $table->string('risco')->nullable();
        });

        Schema::table('empresa_inscricoes', function (Blueprint $table) {
            $table->date('atividade_inicio')->nullable();
            $table->string('risco_mensagem', 500)->nullable();
            $table->string('alvara_pendencia')->nullable();
            $table->string('endereco_bairro')->nullable();
            $table->integer('bloqueio_situacao_id')->nullable();
            $table->string('bloqueio_situacao_descricao')->nullable();
        });*/

        Schema::create('empresa_quadro_societario', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('empresa_id')->nullable();
            $table->string('nome')->nullable();
            $table->date('entrada_data')->nullable();
            $table->date('saida_data')->nullable();
        });

        Schema::create('empresa_inscricao_horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('inscricao_id')->nullable();
            $table->string('descricao')->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_termino')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn(
                ['contabilidade', 'porte', 'risco']
            );
        });

        Schema::table('empresa_inscricoes', function (Blueprint $table) {
            $table->dropColumn(
                ['atividade_inicio', 'risco_mensagem', 'alvara_pendencia', 'endereco_bairro']
            );
        });*/

        Schema::dropIfExists('empresa_quadro_societario');

        Schema::dropIfExists('empresa_inscricao_horarios');
    }
}
