<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocumentosGerados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_gerados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_documento')->nullable();
			$table->string('numero_documento')->nullable();
			$table->string('nome_eng')->nullable();
			$table->string('crea_eng')->nullable();
			$table->string('numero_protocolo')->nullable();
			$table->string('nome_solicitante')->nullable();
			$table->string('end_rua')->nullable();
			$table->string('end_numero')->nullable();
			$table->string('end_setor')->nullable();
			$table->string('end_quadra')->nullable();
			$table->string('end_lote')->nullable();
			$table->string('area_construida')->nullable();
			$table->string('numero_matricula')->nullable();
			$table->string('tipo_predio')->nullable();
			$table->string('tipo_construcao')->nullable();
			$table->string('metragem_com')->nullable();
			$table->string('metragem_res')->nullable();
			$table->string('comodos')->nullable();
			$table->string('comodos_com')->nullable();
			$table->string('comodos_res')->nullable();
			$table->string('obs')->nullable();
            $table->date('data_emissao')->nullable();
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
        Schema::dropIfExists('documentos_gerados');
    }
}
