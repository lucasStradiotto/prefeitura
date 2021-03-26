<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSolicitacaoPodaRetiradaAddAmbiente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacao_poda_retirada', function (Blueprint $table) {
            $table->string('ambiente')->after('tipo_solicitacao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitacao_poda_retirada', function (Blueprint $table) {
            $table->dropColumn(['ambiente']);
        });
    }
}
