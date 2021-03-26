<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSolicitacoesAutorizadasAddConfirmacaoPendente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacoes_autorizadas', function (Blueprint $table) {
            $table->boolean('confirmacao_pendente')->nullable();
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
            $table->dropColumn(['confirmacao_pendente']);
        });
    }
}
