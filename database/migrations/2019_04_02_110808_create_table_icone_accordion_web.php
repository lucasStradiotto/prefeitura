<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIconeAccordionWeb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icone_accordion_web', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link')->nullable();
            $table->string('nome')->nullable();
            $table->string('img')->nullable();
            $table->unsignedBigInteger('icone_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('icone_accordion_web');
    }
}
