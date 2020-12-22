<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReserva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_usuario");
            $table->unsignedBigInteger("id_quarto");
            $table->unsignedBigInteger("id_situacao_de_pagamento"); 
            $table->date("data_entrada");
            $table->date("data_saida");
            $table->unsignedDecimal('valor_a_pagar', 8, 2);
                  
            $table->foreign('id_usuario')->references('id')->on('usuario');
            $table->foreign('id_quarto')->references('id')->on('quarto');
            $table->foreign('id_situacao_de_pagamento')->references('id')->on('situacao_de_pagamento');

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
        Schema::dropIfExists('reserva');
    }
}
