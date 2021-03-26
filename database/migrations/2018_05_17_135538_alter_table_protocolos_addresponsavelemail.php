<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableProtocolosAddresponsavelemail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolos', function (Blueprint $table) {
            $table->string('responsavel_email')->after('responsavel')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('protocolos', function (Blueprint $table) {
            $table->dropColumn('responsavel_email');
        });
    }
}
