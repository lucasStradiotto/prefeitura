<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableMotoristasNullableUserId extends Migration
{
    public function up()
    {
        Schema::table('motoristas', function (Blueprint $table) {
            $table->integer('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('motoristas', function (Blueprint $table) {
            $table->dropColumn('user_id')->change();
        });
    }
}
