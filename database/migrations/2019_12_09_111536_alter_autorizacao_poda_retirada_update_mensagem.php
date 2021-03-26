<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAutorizacaoPodaRetiradaUpdateMensagem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('autorizacao_poda_retirada', function (Blueprint $table) {
            $table->string('mensagem', 1000)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('autorizacao_poda_retirada', function (Blueprint $table) {
            $table->string('mensagem', 255)->nullable()->change();
        });
    }
}
