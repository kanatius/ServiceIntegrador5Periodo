<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstabelecimento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estabelecimento', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 100);
            $table->unsignedBigInteger("id_endereco")->unique();
            $table->unsignedBigInteger("id_tipo_de_estabelecimento");

            $table->foreign('id_endereco')->references('id')->on('endereco');
            $table->foreign('id_tipo_de_estabelecimento')->references('id')->on('tipo_de_estabelecimento');
            
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
        Schema::dropIfExists('estabelecimento');
    }
}
