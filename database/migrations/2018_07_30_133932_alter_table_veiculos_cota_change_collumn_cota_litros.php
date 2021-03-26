<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableVeiculosCotaChangeCollumnCotaLitros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('veiculos_cotas', function (Blueprint $table) {
            $table->dropColumn('cota_litros');
        });

        Schema::table('veiculos_cotas', function (Blueprint $table) {
            $table->float('cota_litros')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('veiculos_cotas', function (Blueprint $table) {
            $table->dropColumn('cota_litros');
        });

        Schema::table('veiculos_cotas', function (Blueprint $table) {
            $table->double('cota_litros')->nullable();
        });
    }
}
