<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTableCercasEletronicasToPoligonos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cercas_eletronicas', function (Blueprint $table) {
            DB::statement("ALTER TABLE cercas_eletronicas RENAME TO poligonos");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poligonos', function (Blueprint $table) {
            DB::statement("ALTER TABLE poligonos RENAME TO cercas_eletronicas");
        });
    }
}
