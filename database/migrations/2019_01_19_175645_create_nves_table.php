<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nfe', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('operacao');
            $table->string('natureza_operacao');
            $table->string('modelo');
            $table->integer('finalidade');
            $table->integer('ambiente');
            $table->string('uuid')->nullable();
            $table->string('status')->nullable();
            $table->integer('nfe')->nullable();
            $table->integer('serie')->nullable();
            $table->string('recibo')->nullable();
            $table->string('chave')->nullable();
            $table->string('xml')->nullable();
            $table->string('danfe')->nullable();
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
        Schema::dropIfExists('nfe');
    }
}
