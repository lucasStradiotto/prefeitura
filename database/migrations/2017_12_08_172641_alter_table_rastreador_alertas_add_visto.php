<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableRastreadorAlertasAddVisto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rastreador_alertas', function (Blueprint $table) {
            $table->boolean('visto')->after('desligado');
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
            $table->dropColumn('visto');
        });
    }
}
