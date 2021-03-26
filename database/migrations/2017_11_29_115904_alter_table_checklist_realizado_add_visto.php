<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableChecklistRealizadoAddVisto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checklist_realizado', function (Blueprint $table) {
            $table->boolean('visto')->after('feito');
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
            $table->dropColumn('visto');
        });
    }
}
