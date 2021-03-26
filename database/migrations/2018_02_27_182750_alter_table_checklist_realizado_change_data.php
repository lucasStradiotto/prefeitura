<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableChecklistRealizadoChangeData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checklist_realizado', function (Blueprint $table) {
            $table->dropColumn('data');
        });
        Schema::table('checklist_realizado', function (Blueprint $table) {
            $table->timestamp('data')->nullable();
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
            $table->dropColumn('data');
        });
        Schema::table('checklist_realizado', function (Blueprint $table) {
            $table->date('data')->nullable();
        });
    }
}
