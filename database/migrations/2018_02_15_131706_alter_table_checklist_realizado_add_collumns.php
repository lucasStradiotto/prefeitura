<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableChecklistRealizadoAddCollumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checklist_realizado', function (Blueprint $table) {
            $table->integer('motorista_id')->nullable();
            $table->integer('rota_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checklist_realizado', function (Blueprint $table) {
            $table->dropColumn('motorista_id');
            $table->dropColumn('rota_id');
        });
    }
}
