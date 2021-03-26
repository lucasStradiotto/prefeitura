<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRastreamentosAddIgnicaoBateria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rastreamentos', function (Blueprint $table) {
            $table->boolean('ignicao')->nullable()->default(null);
            $table->boolean('bateria')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rastreamentos', function (Blueprint $table) {
            $table->dropColumn(['ignicao', 'bateria']);
        });
    }
}
