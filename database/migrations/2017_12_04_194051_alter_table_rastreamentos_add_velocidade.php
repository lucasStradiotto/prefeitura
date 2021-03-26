<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableRastreamentosAddVelocidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rastreamentos', function (Blueprint $table) {
            $table->double('velocidade', 9, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rastreamentos', function (Blueprint $table) {
            $table->dropColumn('velocidade');
        });
    }
}
