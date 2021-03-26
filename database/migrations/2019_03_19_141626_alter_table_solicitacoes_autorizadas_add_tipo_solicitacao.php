<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSolicitacoesAutorizadasAddTipoSolicitacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacoes_autorizadas', function (Blueprint $table) {
            $table->string('tipo_solicitacao')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitacoes_autorizadas', function (Blueprint $table) {
            $table->dropColumn(['tipo_solicitacao']);
        });
    }
}
