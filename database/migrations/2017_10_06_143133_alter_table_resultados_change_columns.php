<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableResultadosChangeColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resultados', function (Blueprint $table) {
            $table->dropColumn('exame_id');
            $table->dropColumn('veiculos_id');
        });
        Schema::table('resultados', function (Blueprint $table) {
            $table->string('exame');
            $table->string('veiculo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resultados', function (Blueprint $table) {
            $table->dropColumn('exame');
            $table->dropColumn('veiculo');
        });
        Schema::table('resultados', function (Blueprint $table) {
            $table->string('exame_id');
            $table->string('veiculos_id');
        });

    }
}
