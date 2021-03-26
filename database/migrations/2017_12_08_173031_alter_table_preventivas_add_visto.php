<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePreventivasAddVisto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preventivas', function (Blueprint $table) {
            $table->boolean('visto')->after('data_ultima_manutencao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('preventivas', function (Blueprint $table) {
            $table->dropColumn('visto');
        });
    }
}
