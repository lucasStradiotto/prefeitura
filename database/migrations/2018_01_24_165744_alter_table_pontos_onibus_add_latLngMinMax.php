<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePontosOnibusAddLatLngMinMax extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pontos_onibus', function (Blueprint $table) {
            $table->string('lat_min')->after('longitude');
            $table->string('lat_max')->after('lat_min');
            $table->string('lng_min')->after('lat_max');
            $table->string('lng_max')->after('lng_min');
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
            $table->dropColumn('lat_min');
            $table->dropColumn('lat_max');
            $table->dropColumn('lng_min');
            $table->dropColumn('lng_max');
        });
    }
}
