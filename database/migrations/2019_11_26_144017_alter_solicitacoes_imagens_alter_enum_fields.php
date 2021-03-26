<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSolicitacoesImagensAlterEnumFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE solicitacoes_imagens CHANGE COLUMN tipo_imagem tipo_imagem ENUM('arvore', 'cpf', 'rg', 'iptu', 'planta')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE solicitacoes_imagens CHANGE COLUMN tipo_imagem tipo_imagem ENUM('arvore', 'cpf', 'rg', 'iptu')");
    }
}
