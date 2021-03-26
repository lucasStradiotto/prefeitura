<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAssuntosNotificacaoAddTextocondicaoTextomultaTextomultaobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('assuntos_notificacao', function (Blueprint $table) {
            $table->string('texto_condicao')->after('para_isso')->nullable();
            $table->string('texto_multa')->after('texto_condicao')->nullable();
            $table->string('texto_multa_obs')->after('texto_multa')->nullable();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {/*
        Schema::table('assuntos_notificacao', function (Blueprint $table) {
            $table->dropColumn(['texto_condicao', 'texto_multa', 'texto_multa_obs']);
        });*/
    }
}