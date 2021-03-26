<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableVeiculosCotasAddMes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('veiculos_cotas', function (Blueprint $table) {
            $table->dropColumn('periodo_inicial');
            $table->dropColumn('periodo_final');
            $table->integer('mes')->nullable();
            $table->integer('ano')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('veiculos_cotas', function (Blueprint $table) {
            $table->dropColumn('mes');
            $table->dropColumn('ano');
            $table->dateTime('periodo_inicial')->nullabel();
            $table->dateTime('periodo_final')->nullabel();

        });
    }
}
