<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSetbairualotChangeUltimaNotificacaoMulta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setores_bairros_ruas_lotes', function (Blueprint $table) {
            $table->string('ultima_notificacao_multa')->change()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setores_bairros_ruas_lotes', function (Blueprint $table) {
            $table->date('ultima_notificacao_multa')->change()->nullable();
        });
    }
}
