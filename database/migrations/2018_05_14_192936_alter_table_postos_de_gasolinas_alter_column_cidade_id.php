<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePostosDeGasolinasAlterColumnCidadeId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('postos_de_gasolinas', function (Blueprint $table) {
            $table->dropColumn('cidade_id');
            $table->string('cidade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('postos_de_gasolinas', function (Blueprint $table) {
            $table->dropColumn('cidade');
            $table->integer('cidade_id')->nullable();
        });
    }
}
