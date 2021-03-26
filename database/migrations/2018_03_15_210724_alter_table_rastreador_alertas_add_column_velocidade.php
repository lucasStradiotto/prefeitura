<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableRastreadorAlertasAddColumnVelocidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rastreador_alertas', function (Blueprint $table) {
            $table->integer('velocidade')->nullable();
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
            $table->dropColumn('velocidade');
        });
    }
}
