<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePoligonosSetcolumnsnull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poligonos', function (Blueprint $table) {
            $table->integer('cerca_numero')->nullable()->change();
            $table->boolean('cerca_gera_notificacao')->nullable()->change();
            $table->boolean('cerca_area_risco')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poligonos', function (Blueprint $table) {
            $table->integer('cerca_numero')->change();
            $table->boolean('cerca_gera_notificacao')->change();
            $table->boolean('cerca_area_risco')->change();
        });
    }
}
