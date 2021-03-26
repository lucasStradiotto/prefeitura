<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterVistoriasEmpresasAddSituacaoData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vistorias_empresas', function (Blueprint $table) {
            $table->integer('vistoria_situacao_id')->nullable();
            $table->string('data_previsao_execucao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vistorias_empresas', function (Blueprint $table) {
            $table->dropColumn(['vistoria_situacao_id', 'data_previsao_execucao']);
        });
    }
}
