<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSolicitacaoRedeEletricaAddtipoestatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacao_rede_eletrica', function (Blueprint $table) {
            $table->unsignedInteger('tipo_solicitacao_id')->nullable()->after('anomalia_id');
            $table->unsignedInteger('status_solicitacao_id')->nullable()->after('tipo_solicitacao_id');
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
            $table->dropColumn('tipo_solicitacao_id');
            $table->dropColumn('status_solicitacao_id');
        });
    }
}
