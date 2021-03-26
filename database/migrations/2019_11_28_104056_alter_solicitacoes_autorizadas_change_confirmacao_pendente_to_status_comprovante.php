<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSolicitacoesAutorizadasChangeConfirmacaoPendenteToStatusComprovante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE solicitacoes_autorizadas CHANGE COLUMN confirmacao_pendente status_comprovante ENUM('pendente', 'analisando', 'finalizado')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE solicitacoes_autorizadas CHANGE COLUMN status_comprovante confirmacao_pendente BOOLEAN");
    }
}
