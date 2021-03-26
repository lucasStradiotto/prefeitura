<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOrdemColetasRefactorColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordem_coletas', function (Blueprint $table) {
            $table->renameColumn('material_predominante_id', 'tipo_entulho_id');
            $table->renameColumn('numero_casa_cobranca_id', 'numero_casa_cobranca');
        });

        Schema::table('ordem_coletas', function (Blueprint $table) {
            $table->string('nome_solicitante')->nullable()->change();
            $table->dateTime('data')->nullable()->change();
            $table->float('valor')->nullable()->change();
            $table->string('telefone')->nullable()->change();
            $table->string('numero_ctr')->nullable()->change();
            $table->unsignedInteger('tipo_entulho_id')->nullable()->change();
            $table->unsignedInteger('endereco_cobranca_id')->nullable()->change();
            $table->unsignedInteger('bairro_cobranca_id')->nullable()->change();
            $table->unsignedInteger('numero_casa_cobranca')->nullable()->change();
            $table->unsignedInteger('endereco_obra_id')->nullable()->change();
            $table->unsignedInteger('bairro_obra_id')->nullable()->change();
            $table->unsignedInteger('numero_obra')->nullable()->change();
            $table->unsignedInteger('veiculo_id')->nullable()->change();
            $table->unsignedInteger('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ordem_coletas', function (Blueprint $table) {
            $table->renameColumn('tipo_entulho_id', 'material_predominante_id');
            $table->renameColumn('numero_casa_cobranca', 'numero_casa_cobranca_id');
        });

        Schema::table('ordem_coletas', function (Blueprint $table) {
            $table->string('nome_solicitante')->change();
            $table->dateTime('data')->change();
            $table->float('valor')->change();
            $table->string('telefone')->change();
            $table->string('numero_ctr')->change();
            $table->unsignedInteger('material_predominante_id')->change();
            $table->unsignedInteger('endereco_cobranca_id')->change();
            $table->unsignedInteger('bairro_cobranca_id')->change();
            $table->unsignedInteger('numero_casa_cobranca_id')->change();
            $table->unsignedInteger('endereco_obra_id')->change();
            $table->unsignedInteger('bairro_obra_id')->change();
            $table->unsignedInteger('numero_obra')->change();
            $table->unsignedInteger('veiculo_id')->change();
            $table->unsignedInteger('user_id')->change();
        });
    }
}
