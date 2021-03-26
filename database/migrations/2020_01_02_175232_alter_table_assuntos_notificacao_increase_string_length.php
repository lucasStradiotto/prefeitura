<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAssuntosNotificacaoIncreaseStringLength extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {/*
        Schema::table('assuntos_notificacao', function (Blueprint $table) {
            $table->string('texto_verificado', 1000)->change();
            $table->string('para_isso', 1000)->change();
            $table->string('texto_condicao', 1000)->change();
            $table->string('texto_multa', 1000)->change();
            $table->string('capitulacao', 1000)->change();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('assuntos_notificacao', function (Blueprint $table) {
            $table->string('texto_verificado', 255);
            $table->string('para_isso', 255);
            $table->string('texto_condicao', 191);
            $table->string('texto_multa', 191);
            $table->string('capitulacao', 191);
        });*/
    }
}
