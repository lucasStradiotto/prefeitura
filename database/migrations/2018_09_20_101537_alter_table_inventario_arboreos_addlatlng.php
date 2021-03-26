<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableInventarioArboreosAddlatlng extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventario_arboreos', function (Blueprint $table) {
            $table->string('latitude')->nullable()->after('quadrante_id');
            $table->string('longitude')->nullable()->after('latitude');
            $table->dropColumn('rua');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventario_arboreos', function (Blueprint $table) {
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
            $table->string('rua')->nullable();
        });
    }
}
