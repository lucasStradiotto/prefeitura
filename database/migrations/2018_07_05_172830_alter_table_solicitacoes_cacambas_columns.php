<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSolicitacoesCacambasColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacoes_cacambas', function (Blueprint $table) {
            $table->string('data_solicitacao')->nullable()->change();
            $table->string('data_aceitacao')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitacoes_cacambas', function (Blueprint $table) {
            $table->date('data_solicitacao')->nullable()->change();
            $table->date('data_aceitacao')->nullable()->change();
        });
    }
}
