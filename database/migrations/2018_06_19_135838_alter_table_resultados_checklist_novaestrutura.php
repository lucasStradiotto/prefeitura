<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableResultadosChecklistNovaestrutura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resultados_checklist', function (Blueprint $table) {
            $table->dropColumn('veiculo');
            $table->dropColumn('resultado_final');
            $table->dropColumn('padrao_informado');
        });

        Schema::table('resultados_checklist', function (Blueprint $table) {
            $table->integer('veiculo_id')->nullable();
            $table->string('resultado')->nullable();
            $table->string('resultado_esperado')->nullable();
            $table->string('resultado_inesperado')->nullable();
            $table->boolean('anomalia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resultados_checklist', function (Blueprint $table) {
            $table->string('veiculo')->nullable();
            $table->string('resultado_final')->nullable();
            $table->string('padrao_informado')->nullable();
        });

        Schema::table('resultados_checklist', function (Blueprint $table) {
            $table->dropColumn('veiculo_id');
            $table->dropColumn('resultado');
            $table->dropColumn('resultado_esperado');
            $table->dropColumn('resultado_inesperado');
            $table->dropColumn('anomalia');
        });
    }
}
