<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableMotorista extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('motoristas', function (Blueprint $table) {
            //
            $table->string('cnh_numero')->nullable()->change();
            $table->string('cnh_categoria')->nullable()->change();
            $table->string('cpf')->nullable()->change();
            $table->string('rg')->nullable()->change();
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
            //
            $table->dropColumn('cnh_numero');
            $table->dropColumn('cnh_categoria');
            $table->dropColumn('cpf');
            $table->dropColumn('rg');
        });
    }
}
