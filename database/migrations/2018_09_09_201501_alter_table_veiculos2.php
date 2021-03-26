<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableVeiculos2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('veiculos', function (Blueprint $table) {
            $table->string('modelo')->nullable()->change();
            $table->integer('n_serie_rastreador')->nullable()->change();
            $table->string('cor')->nullable()->change();
            $table->string('ano')->nullable()->change();
            $table->string('fabricante')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('veiculos', function (Blueprint $table) {
            //
            $table->dropColumn('modelo');
            $table->dropColumn('n_serie_rastreador');
            $table->dropColumn('cor');
            $table->dropColumn('ano');
            $table->dropColumn('fabricante');
        });
    }
}
