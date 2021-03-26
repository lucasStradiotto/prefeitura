<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSolicitacoesCacambasAddTamanho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacoes_cacambas', function (Blueprint $table) {
            $table->float('tamanho_cacamba')->nullable();
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
            $table->dropColumn('tamanho_cacamba');
        });
    }
}
