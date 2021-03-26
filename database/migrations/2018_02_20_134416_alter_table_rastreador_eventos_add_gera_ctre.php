<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableRastreadorEventosAddGeraCtre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rastreador_eventos', function (Blueprint $table) {
            $table->boolean('gera_ctre')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rastreador_eventos', function (Blueprint $table) {
            $table->dropColumn('gera_ctre');
        });
    }
}
