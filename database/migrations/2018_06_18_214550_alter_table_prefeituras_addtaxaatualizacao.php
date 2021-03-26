<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePrefeiturasAddtaxaatualizacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prefeituras', function (Blueprint $table) {
            $table->integer('taxa_atualizacao')->nullable()->after('cidade');
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
            $table->dropColumn('taxa_atualizacao');
        });
    }
}
