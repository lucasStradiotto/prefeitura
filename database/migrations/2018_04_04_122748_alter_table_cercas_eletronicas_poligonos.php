<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCercasEletronicasPoligonos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cercas_eletronicas', function (Blueprint $table) {
            $table->integer('tipo_poliono_id')->after('nome');
            $table->string('numero')->nullable()->change();
            $table->string('notificacao')->nullable()->change();
            $table->string('area_risco')->nullable()->change();
            $table->renameColumn('numero', 'cerca_numero');
            $table->renameColumn('notificacao', 'cerca_gera_notificacao');
            $table->renameColumn('area_risco', 'cerca_area_risco');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cercas_eletronicas', function (Blueprint $table) {
            $table->renameColumn('cerca_numero', 'numero');
            $table->renameColumn('cerca_gera_notificacao', 'notificacao');
            $table->renameColumn('cerca_area_risco', 'area_risco');
            $table->string('numero')->change();
            $table->string('notificacao')->change();
            $table->string('area_risco')->change();
            $table->dropColumn('tipo_poliono_id');
        });
    }
}
