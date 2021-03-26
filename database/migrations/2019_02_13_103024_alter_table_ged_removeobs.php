<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableGedRemoveobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ged', function (Blueprint $table) {
            $table->dropColumn('obs1');
            $table->dropColumn('obs2');
            $table->dropColumn('obs3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ged', function (Blueprint $table) {
            $table->string('obs1')->nullable();
            $table->string('obs2')->nullable();
            $table->string('obs3')->nullable();
        });
    }
}
