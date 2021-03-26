<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposTabelaVeiculos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('veiculos', function(Blueprint $table)
        {
            $table->string('renavam')->nullable();
            $table->string('patrimonio')->nullable();
            $table->string('localizacao')->nullable();
            $table->string('status')->nullable();
            $table->integer('categoria')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('veiculos', function(Blueprint $table)
        {
            $table->dropColumn('renavam');
            $table->dropColumn('patrimonio');
            $table->dropColumn('localizacao');
            $table->dropColumn('status');
            $table->dropColumn('categoria');
        });
    }
}
