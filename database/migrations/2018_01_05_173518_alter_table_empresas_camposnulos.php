<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableEmpresasCamposnulos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function(Blueprint $table) {
            $table->string('inscricao_municipal')->nullable()->change();
            $table->string('inscricao_estadual')->nullable()->change();
            $table->string('logradouro')->nullable()->change();
            $table->string('cidade')->nullable()->change();
            $table->string('estado')->nullable()->change();
            $table->string('bairro')->nullable()->change();
            $table->string('responsavel')->nullable()->change();
            $table->string('telefone')->nullable()->change();
            $table->integer('cep')->nullable()->change();
            $table->integer('numero')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function(Blueprint $table) {
            $table->string('inscricao_municipal');
            $table->string('inscricao_estadual');
            $table->string('logradouro');
            $table->string('cidade');
            $table->string('estado');
            $table->string('bairro');
            $table->string('responsavel');
            $table->string('telefone');
            $table->integer('cep');
            $table->integer('numero');
        });
    }
}
