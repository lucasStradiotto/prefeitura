<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterNotificacoesEmpresasAddInscricaoId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notificacoes_empresas', function (Blueprint $table) {
            $table->dropColumn('vistoria_id');
            $table->unsignedInteger('inscricao_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notificacoes_empresas', function (Blueprint $table) {
            $table->dropColumn('inscricao_id');
            $table->unsignedInteger('vistoria_id')->nullable();
        });
    }
}
