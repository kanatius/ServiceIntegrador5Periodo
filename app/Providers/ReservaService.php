<?php

namespace App\Providers;

use App\Models\Reserva;
use App\Models\ReservaDAO;
use DateTime;


use Illuminate\Support\ServiceProvider;
use stdClass;

class ReservaService extends ServiceProvider
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

    public static function getDataReserva($reserva)
    {
        $situacaoDePagamento = SituacaoDePagamentoService::getSituacaoByIdReserva($reserva->id_situacao_de_pagamento);
        $quarto = QuartoService::getQuatoById($reserva->id_quarto);
        $tipoDeQuarto = TipoDeQuartoService::getTipoDeQuartoById($quarto->id_tipo_de_quarto);
        $estabelecimento = EstabelecimentoService::getEstabelecimentoById($quarto->id_estabelecimento);

        $quarto->tipo_de_quarto = $tipoDeQuarto;
        $quarto->estabelecimento = $estabelecimento;

        unset($quarto->id_tipo_de_quarto);
        unset($quarto->id_estabelecimento);
        unset($estabelecimento->id_tipo_de_estabelecimento);
        unset($estabelecimento->id_endereco);

        return (object)[
            "id" => $reserva->id,
            "data_entrada" => $reserva->data_entrada,
            "data_saida" => $reserva->data_saida,
            "valor_a_pagar" => $reserva->valor_a_pagar,
            "situacao_de_pagamento" => $situacaoDePagamento,
            "quarto" => $quarto
        ];
    }

    public static function getReservasByUserId($userId)
    {
        $reservas = ReservaDAO::getReservasByIdUsuario($userId);

        $reservasObj = [];

        foreach ($reservas as $reserva) {
            $resAux = ReservaService::getDataReserva($reserva);
            array_push($reservasObj, $resAux);
        }
        return $reservasObj;
    }

    public static function getQtdReservasByUserId($userId, $offset, $qtd)
    {
        $reservas = ReservaDAO::getQtdReservasByIdUsuario($userId, $offset, $qtd);

        $reservasObj = [];

        foreach ($reservas as $reserva) {
          array_push($reservasObj,  ReservaService::getDataReserva($reserva));
        }
        return $reservasObj;
    }


    public static function getReservasById($id)
    {
        return ReservaDAO::findById($id);
    }


    // public static function pagarReserva(Usuario $usuario, Reserva $reserva)
    // {

    //     if (SituacaoDePagamentoService::getSituacaoByReserva($reserva)->getId() == SituacaoDePagamentoService::getSituacaoPagamentoPago()->getId()) {
    //         return false;
    //     }

    //     //se o usuario não for dono da reserva
    //     if ($usuario->getId() != ReservaDAO::getIdUsuario($reserva)) {
    //         return false;
    //     }

    //     //$pagamento = PagamentoService pagar();
    //     $pagamento = true;

    //     if ($pagamento) {
    //         ReservaService::getDataReserva($reserva);
    //         $reserva->setSituacaoDoPagamento(SituacaoDePagamentoService::getSituacaoPagamentoPago());
    //         return ReservaDAO::update_($reserva);
    //     }
    //     return false;
    // }

    // public static function cancelarReserva(Usuario $usuario, Reserva $reserva)
    // {

    //     if (SituacaoDePagamentoService::getSituacaoByReserva($reserva)->getId() == SituacaoDePagamentoService::getSituacaoPagamentoCancelado()->getId()) {
    //         return false;
    //     }

    //     //se o usuario não for dono da reserva
    //     if ($usuario->getId() != ReservaDAO::getIdUsuario($reserva)) {
    //         return false;
    //     }

    //     //$pagamento = PagamentoService extorno();
    //     $extorno = true;

    //     if ($extorno) {
    //         ReservaService::getDataReserva($reserva);
    //         $reserva->setSituacaoDoPagamento(SituacaoDePagamentoService::getSituacaoPagamentoCancelado());
    //         return ReservaDAO::update_($reserva);
    //     }
    //     return false;
    // }

    
    public static function reservarQuarto($idQuarto, $dataEntrada, $dataSaida, $usuarioId, $usuarioToken)
    {

        if(!AutenticacaoService::verifyToken($usuarioId, $usuarioToken))
                return json_encode([
                    "status" => false,
                    "mensagem" => "Usuário não autenticado!"
                ]);

        if(new DateTime($dataSaida) <= new DateTime($dataEntrada)){
            return json_encode([
                "status" => false,
                "mensagem" => "Data de check out deve ser após data de check in"
            ]);
        }    
        
        if(ReservaService::verifyDisponibilidade($idQuarto, $dataEntrada, $dataSaida)){
            $reserva = new stdClass;
            $reserva->id_situacao_de_pagamento = SituacaoDePagamentoService::getSituacaoPagamentoAguardando()->id;
            
            $reserva->id_quarto = $idQuarto;
            $reserva->id_usuario = $usuarioId;
            $reserva->data_entrada = $dataEntrada;
            $reserva->data_saida = $dataSaida; 
            $reserva->valor_a_pagar = ReservaService::calculateValorApagar($idQuarto, $dataEntrada, $dataSaida);
            
            if (ReservaDAO::insert($reserva) > 0)
                return [
                    "status" => true,
                    "mensagem" => "Reserva cadastrada com sucesso!"
                ];
        }
        return [
            "status" => false,
            "mensagem" => "Quarto indisponível!"
        ];
    }

    public static function calculateValorApagar($idQuarto, $dataEntrada, $dataSaida){
        $de = new DateTime($dataEntrada);
        $ds = new DateTime($dataSaida);
        $intervalo = date_diff($ds, $de);
        $qtdDias = $intervalo->d;
        $valorDoQuarto = QuartoService::getQuatoById($idQuarto)->valor;
        return $qtdDias * $valorDoQuarto;
    }


    public static function verifyDisponibilidade($IdQuarto, $dataEntrada, $dataSaida)
    {
        $reserva = ReservaDAO::getReservaByDates($IdQuarto, $dataEntrada, $dataSaida);
        //se não tiver reserva, retorna true
        if (is_null($reserva)) {
            return true;
        }
        return false;
    }

}
