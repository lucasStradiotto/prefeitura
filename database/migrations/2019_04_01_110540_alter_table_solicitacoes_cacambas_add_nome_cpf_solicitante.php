<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSolicitacoesCacambasAddNomeCpfSolicitante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacoes_cacambas', function (Blueprint $table) {
            $table->string('nome_solicitante')->after('celular_solicitante')->nullable();
            $table->string('cpf_solicitante')->after('nome_solicitante')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitacoes_cacambas', function (Blueprint $table) {
            $table->dropColumn(['nome_solicitante', 'cpf_solicitante']);
        });
    }
}
