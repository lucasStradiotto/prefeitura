<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSolicitacoesAutorizadasAddTelefone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacoes_autorizadas', function (Blueprint $table) {
            $table->string('telefone_solicitante')->after('nome_solicitante')->nullable();
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
            $table->dropColumn(['telefone_solicitante']);
        });
    }
}
