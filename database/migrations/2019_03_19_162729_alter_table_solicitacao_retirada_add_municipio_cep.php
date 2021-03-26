<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSolicitacaoRetiradaAddMunicipioCep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacao_retirada', function (Blueprint $table) {
            $table->string('cep')->nullable()->after('cpf');
            $table->string('municipio')->nullable()->after('cep');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitacao_retirada', function (Blueprint $table) {
            $table->dropColumn(['cep', 'municipio']);
        });
    }
}
