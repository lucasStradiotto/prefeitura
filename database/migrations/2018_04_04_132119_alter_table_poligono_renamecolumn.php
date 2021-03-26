<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePoligonoRenamecolumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poligonos', function (Blueprint $table) {
            $table->renameColumn('tipo_poliono_id', 'tipo_poligono_id');
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
            $table->renameColumn('tipo_poligono_id', 'tipo_poliono_id');
        });
    }
}
