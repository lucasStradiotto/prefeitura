<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableMotoristasAddInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('motoristas', function (Blueprint $table) {
            $table->dropColumn('cnh');

            $table->string('cnh_numero');
            $table->string('cnh_categoria');
            $table->string('cnh_validade');
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
            $table->string('cnh');

            $table->dropColumn('cnh_numero');
            $table->dropColumn('cnh_categoria');
            $table->dropColumn('cnh_validade');
        });
    }
}
