<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableVeiculosAddInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('veiculos', function (Blueprint $table) {
//            $table->dropColumn('id_categoria');

            $table->integer('id_tipo_veiculo')->unsigned();
            $table->foreign('id_tipo_veiculo')
                ->references('id')
                ->on('tipo_veiculos');

            $table->string('fabricante');
            $table->string('modelo');
            $table->string('ano');
            $table->string('cor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('veiculos', function (Blueprint $table) {
//            $table->integer('id_categoria')->unsigned();

            $table->dropColumn('fabricante');
            $table->dropColumn('modelo');
            $table->dropColumn('ano');
            $table->dropColumn('cor');

        });
    }
}
