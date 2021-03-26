<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableVerticesCercaRenamecolumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vertices_cerca', function (Blueprint $table) {
            $table->renameColumn('cerca_id', 'poligono_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vertices_cerca', function (Blueprint $table) {
            $table->renameColumn('poligono_id', 'cerca_id');
        });
    }
}
