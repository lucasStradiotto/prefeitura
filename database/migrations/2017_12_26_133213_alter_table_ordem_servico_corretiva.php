<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOrdemServicoCorretiva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordem_servico_corretivas', function (Blueprint $table) {
            $table->dateTime('data_execucao')->nullable()->change();
            $table->string('horario_inicio')->nullable()->change();
            $table->string('horario_fim')->nullable()->change();
            $table->string('servico')->nullable()->change();
            $table->dropColumn('valor_total');
        });

        Schema::table('ordem_servico_corretivas', function(Blueprint $table) {
           $table->float('valor_total', 8, 2)->nullable()->after('ferramenta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ordem_servico_corretivas', function(Blueprint $table) {
            $table->dropColumn('valor_total');
        });

        Schema::table('ordem_servico_corretivas', function (Blueprint $table) {
            $table->dateTime('data_execucao')->change();
            $table->string('horario_inicio')->change();
            $table->string('horario_fim')->change();
            $table->string('servico')->change();
            $table->double('valor_total');
        });
    }
}
