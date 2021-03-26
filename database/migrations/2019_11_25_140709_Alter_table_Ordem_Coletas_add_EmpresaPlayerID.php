<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOrdemColetasAddEmpresaPlayerID extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordem_coletas', function (Blueprint $table) {
            $table->string('player_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ordem_coletas', function (Blueprint $table) {
            $table->dropColumn('player_id');
        });
    }
}
