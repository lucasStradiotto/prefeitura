<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableTipoVeiculosAddinstrumentomedicao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipo_veiculos', function (Blueprint $table) {
            $table->string('instrumento_medida')->nullable()->after('icone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipo_veiculos', function (Blueprint $table) {
            $table->dropColumn('instrumento_medida');
        });
    }
}
