<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableItemAccordionWeb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_accordion_web', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link')->nullable();
            $table->string('nome')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('javascript_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_accordion_web');
    }
}
