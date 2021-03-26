<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRastreadorIpPorta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rastreador_ip_porta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rastreador_id')->unique();
            $table->string('ip');
            $table->string('porta');
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
        Schema::dropIfExists('rastreador_ip_porta');
    }
}
