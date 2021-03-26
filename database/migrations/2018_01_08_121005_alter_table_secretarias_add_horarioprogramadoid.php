<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSecretariasAddHorarioprogramadoid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('secretarias', function (Blueprint $table) {
            $table->integer('horario_programado_id')->unsigned()->after('nome');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('secretarias', function (Blueprint $table) {
            $table->dropColumn('horario_programado_id');
        });
    }
}
