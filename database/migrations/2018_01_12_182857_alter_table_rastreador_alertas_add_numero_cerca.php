<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableRastreadorAlertasAddNumeroCerca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rastreador_alertas', function (Blueprint $table) {
            $table->integer('numero_cerca')->nullable();
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
            $table->dropColumn('numero_cerca');
        });
    }
}
