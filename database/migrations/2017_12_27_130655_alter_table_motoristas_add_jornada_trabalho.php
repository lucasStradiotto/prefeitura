<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableMotoristasAddJornadaTrabalho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('motoristas', function (Blueprint $table) {
            $table->integer('jornada_trabalho_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('motoristas', function (Blueprint $table) {
            $table->dropColumn('jornada_trabalho_id');
        });
    }
}
