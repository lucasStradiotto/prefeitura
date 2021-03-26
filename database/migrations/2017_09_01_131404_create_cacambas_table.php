<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCacambasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cacambas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');

            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')
                ->references('id')
                ->on('empresas');

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
        Schema::dropIfExists('cacambas');
    }
}
