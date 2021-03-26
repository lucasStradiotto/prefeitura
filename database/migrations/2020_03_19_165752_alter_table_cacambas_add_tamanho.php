<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCacambasAddTamanho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cacambas', function (Blueprint $table) {
            $table->float('tamanho')->nullable()->after('codigo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cacambas', function (Blueprint $table) {
            $table->dropColumn('tamanho');
        });
    }
}
