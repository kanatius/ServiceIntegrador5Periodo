<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuarto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quarto', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("andar");
            $table->unsignedInteger("numero");
            $table->unsignedDecimal('valor', 8, 2);
            $table->unsignedBigInteger("id_tipo_de_quarto");
            $table->unsignedBigInteger("id_estabelecimento");

            $table->foreign('id_tipo_de_quarto')->references('id')->on('tipo_de_quarto');
            $table->foreign('id_estabelecimento')->references('id')->on('estabelecimento');

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
        Schema::dropIfExists('quarto');
    }
}
