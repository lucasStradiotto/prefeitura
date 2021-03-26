<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePontosOnibusChangeNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pontos_onibus', function (Blueprint $table) {
            $table->dropColumn(['lat_min', 'lat_max', 'lng_min', 'lng_max']);
            $table->string('cima')->after('longitude');
            $table->string('direita')->after('cima');
            $table->string('baixo')->after('direita');
            $table->string('esquerda')->after('baixo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pontos_onibus', function (Blueprint $table) {
            $table->dropColumn(['cima', 'direita', 'baixo', 'esquerda']);
            $table->string('lat_min');
            $table->string('lat_max');
            $table->string('lng_min');
            $table->string('lng_max');
        });
    }
}
