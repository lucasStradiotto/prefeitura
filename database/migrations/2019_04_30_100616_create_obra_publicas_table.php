<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObraPublicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras_publicas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('obra_identificador')->nullable();
            $table->string('nome')->nullable();
            $table->string('contrato')->nullable();
            $table->string('convenio')->nullable();
            $table->string('empresa')->nullable();
            $table->string('fiscal')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('obras_publicas');
    }
}
