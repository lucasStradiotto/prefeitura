<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVistoriasEmpresasTelefones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vistorias_empresas_telefones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vistoria_id')->nullable();
            $table->string('ddd')->nullable();
            $table->string('telefone')->nullable();
            $table->string('descricao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vistorias_empresas_telefones');
    }
}
