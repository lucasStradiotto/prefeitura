<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAnomaliasAddprazo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anomalias', function (Blueprint $table) {
            $table->integer('prazo')->nullable()->after('nome');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anomalias', function (Blueprint $table) {
            $table->dropColumn('prazo');
        });
    }
}
