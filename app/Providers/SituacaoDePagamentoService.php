<?php

namespace App\Providers;

use App\Models\Reserva;
use App\Models\ReservaDAO;
use App\Models\SituacaoDePagamento;
use App\Models\SituacaoDePagamentoDAO;

use Illuminate\Support\ServiceProvider;

class SituacaoDePagamentoService extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public static function getSituacaoByIdReserva($id){
        return SituacaoDePagamentoDAO::findById($id);
    }

    public static function getSituacaoPagamentoAguardando(){
        return (object) ["id" => 1, "nome" => "Aguardando"];
    }

    public static function getSituacaoPagamentoPago(){
        return (object)["id" => 2, "nome" => "Pago"];
    }

    public static function getSituacaoPagamentoCancelado(){
        return (object) ["id" => 3, "nome" => "Cancelado"];
    }
}
