<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePrefeiturasAddZoomlevel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prefeituras', function (Blueprint $table) {
            $table->string('zoom_level')->after('lng')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prefeituras', function (Blueprint $table) {
            $table->dropColumn(['zoom_level']);
        });
    }
}
