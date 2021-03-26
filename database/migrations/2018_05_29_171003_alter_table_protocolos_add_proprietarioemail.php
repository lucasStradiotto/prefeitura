<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableProtocolosAddProprietarioemail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolos', function (Blueprint $table) {
            $table->string('proprietario_email')->nullable()->after('proprietario');
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
            $table->dropColumn('proprietario_email');
        });
    }
}
