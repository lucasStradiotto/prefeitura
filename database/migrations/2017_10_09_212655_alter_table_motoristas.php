<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableMotoristas extends Migration
{
    public function up()
    {
        Schema::table('motoristas', function (Blueprint $table) {
            $table->dropColumn('cnh_validade');
        });

        Schema::table('motoristas', function (Blueprint $table) {
            $table->dateTime('cnh_validade')->nullable();
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
            $table->dropColumn('cnh_validade');
        });

        Schema::table('motoristas', function (Blueprint $table) {
            $table->string('cnh_validade')->nullable();
        });



    }
}
