<?php

use App\Providers\SituacaoDePagamentoService;
use App\Models\SituacaoDePagamentoDAO;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InsertSituacaoDePagamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $aguardando = SituacaoDePagamentoService::getSituacaoPagamentoAguardando();
        $pago = SituacaoDePagamentoService::getSituacaoPagamentoPago();
        $cancelado = SituacaoDePagamentoService::getSituacaoPagamentoCancelado();

        SituacaoDePagamentoDAO::insertAll([$aguardando, $pago, $cancelado]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table("situacao_de_pagamento")->where("id", ">", 0)->delete();
    }
}
