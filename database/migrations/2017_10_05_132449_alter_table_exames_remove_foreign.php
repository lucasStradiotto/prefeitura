<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableExamesRemoveForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exames', function (Blueprint $table) {
            $table->dropForeign(['tipo_exame_id']);
            $table->dropForeign(['tipo_padroes_id']);
            $table->dropForeign(['padrao_esperado_id']);
            $table->dropForeign(['min_esperado_id']);
            $table->dropForeign(['max_esperado_id']);

            $table->dropColumn('tipo_exame_id');
            $table->dropColumn('tipo_padroes_id');
            $table->dropColumn('padrao_esperado_id');
            $table->dropColumn('min_esperado_id');
            $table->dropColumn('max_esperado_id');
        });

        Schema::table('exames', function (Blueprint $table) {
            $table->integer('tipo_exame_id')->nullable();
            $table->integer('tipo_padroes_id')->nullable();
            $table->integer('padrao_esperado_id')->nullable();
            $table->integer('min_esperado_id')->nullable();
            $table->integer('max_esperado_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exames', function (Blueprint $table) {
            $table->dropColumn('tipo_exame_id');
            $table->dropColumn('tipo_padroes_id');
            $table->dropColumn('padrao_esperado_id');
            $table->dropColumn('min_esperado_id');
            $table->dropColumn('max_esperado_id');
        });

        Schema::table('exames', function (Blueprint $table) {
            $table->integer('tipo_exame_id')->unsigned();
            $table->foreign('tipo_exame_id')
                ->references('id')
                ->on('tipo_exames');

            $table->integer('tipo_padroes_id')->unsigned();
            $table->foreign('tipo_padroes_id')
                ->references('id')
                ->on('tipo_padroes');

            $table->integer('padrao_esperado_id')->unsigned();
            $table->foreign('padrao_esperado_id')
                ->references('id')
                ->on('padroes');

            $table->integer('min_esperado_id')->unsigned();
            $table->foreign('min_esperado_id')
                ->references('id')
                ->on('padroes');

            $table->integer('max_esperado_id')->unsigned();
            $table->foreign('max_esperado_id')
                ->references('id')
                ->on('padroes');
        });
    }
}
