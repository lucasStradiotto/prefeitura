<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSolicitacoesImagensAddTipoImagem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacoes_imagens', function (Blueprint $table) {
            $table->enum('tipo_imagem', ['arvore', 'cpf', 'rg', 'iptu'])
                ->after('tipo_solicitacao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitacoes_imagens', function (Blueprint $table) {
            $table->dropColumn(['tipo_imagem']);
        });
    }
}
