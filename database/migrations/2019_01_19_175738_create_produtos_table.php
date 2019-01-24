<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('ncm');
            $table->integer('quantidade');
            $table->string('unidade');
            $table->float('peso');
            $table->integer('origem');
            $table->float('subtotal');
            $table->float('total');
            $table->integer('nfe_id')->unsigned();
            $table->foreign('nfe_id')->references('id')->on('nfe');
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
        Schema::dropIfExists('produtos');
    }
}
