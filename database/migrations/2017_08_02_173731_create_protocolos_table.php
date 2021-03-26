<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocolosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocolos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('endereco')->nullable();
            $table->string('numero');
            $table->string('status');
            $table->string('observacaoStatus')->nullable();
            $table->string('responsavel')->nullable();
            $table->string('protF')->nullable();
            $table->string('retiradoPor')->nullable();
            $table->string('assunto');
            $table->string('comodos', 500);
            $table->string('proprietario');
            $table->string('setor');
            $table->string('quadra');
            $table->string('lote');
            $table->string('l');

            $table->integer('livro')->nullable();
            $table->integer('pagina')->nullable();

            $table->double('m2')->nullable();
            $table->double('taxa')->nullable();

            $table->boolean('dt');

            $table->date('data_retirada')->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();

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
        Schema::dropIfExists('protocolos');
    }
}
