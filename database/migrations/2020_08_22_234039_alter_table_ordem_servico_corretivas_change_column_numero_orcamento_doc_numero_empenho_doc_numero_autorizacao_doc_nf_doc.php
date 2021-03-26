<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOrdemServicoCorretivasChangeColumnNumeroOrcamentoDocNumeroEmpenhoDocNumeroAutorizacaoDocNfDoc extends Migration
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
            $table->string('numero_orcamento_doc')->nullable()->change();
            $table->string('numero_empenho_doc')->nullable()->change();
            $table->string('numero_autorizacao_doc')->nullable()->change();
            $table->string('nf_doc')->nullable()->change();
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
