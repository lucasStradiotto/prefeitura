<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPrefeiturasAddSolicitacaoArborizacaoAnexarRgCpfIptu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prefeituras', function (Blueprint $table) {
            $table->boolean('solicitacao_arborizacao_anexar_rg_cpf_iptu')->after('termo_compromisso')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prefeituras', function (Blueprint $table) {
            $table->dropColumn(['solicitacao_arborizacao_anexar_rg_cpf_iptu']);
        });
    }
}
