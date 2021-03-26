<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableRastreadorAlertaRenameDesligado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('rastreador_alertas', function (Blueprint $table) {
            $table->dropColumn('desligado');
            $table->integer('tipo_alerta')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rastreador_alertas', function (Blueprint $table) {
            $table->dropColumn('tipo_alerta');
            $table->tinyInteger('desligado')->nullable();
        });
    }
}
