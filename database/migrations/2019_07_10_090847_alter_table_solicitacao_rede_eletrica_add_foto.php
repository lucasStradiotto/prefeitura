<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSolicitacaoRedeEletricaAddFoto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacao_rede_eletrica', function (Blueprint $table) {
            $table->string('foto')->after('nome_solicitante')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitacao_rede_eletrica', function (Blueprint $table) {
            $table->dropColumn(['foto']);
        });
    }
}
