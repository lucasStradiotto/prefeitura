<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOrdemServicoCorretivasAddColumnNumeroOrcamentoDocNumeroEmpenhoDocNumeroAutorizacaoDocNfDoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordem_servico_corretivas', function(Blueprint $table)
        {
            $table->unsignedInteger('numero_orcamento_doc')->nullable();
            $table->unsignedInteger('numero_empenho_doc')->nullable();
            $table->unsignedInteger('numero_autorizacao_doc')->nullable();
            $table->unsignedInteger('nf_doc')->nullable();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ordem_servico_corretivas', function(Blueprint $table)
        {
            $table->dropColumn('numero_orcamento_doc');
            $table->dropColumn('numero_empenho_doc');
            $table->dropColumn('numero_autorizacao_doc');
            $table->dropColumn('nf_doc');
        });
    }
}
