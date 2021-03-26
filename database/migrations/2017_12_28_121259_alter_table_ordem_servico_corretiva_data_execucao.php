<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOrdemServicoCorretivaDataExecucao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordem_servico_corretivas', function (Blueprint $table) {
            $table->date('data_execucao')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ordem_servico_corretivas', function (Blueprint $table) {
            $table->dateTime('data_execucao')->nullable()->change();
        });
    }
}
