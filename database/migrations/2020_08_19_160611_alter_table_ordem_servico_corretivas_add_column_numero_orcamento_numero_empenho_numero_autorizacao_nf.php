<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOrdemServicoCorretivasAddColumnNumeroOrcamentoNumeroEmpenhoNumeroAutorizacaoNf extends Migration
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
            $table->unsignedInteger('numero_orcamento')->nullable();
            $table->unsignedInteger('numero_empenho')->nullable();
            $table->unsignedInteger('numero_autorizacao')->nullable();
            $table->unsignedInteger('nf')->nullable();
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
            $table->dropColumn('numero_orcamento');
            $table->dropColumn('numero_empenho');
            $table->dropColumn('numero_autorizacao');
            $table->dropColumn('nf');
        });
    }
}
