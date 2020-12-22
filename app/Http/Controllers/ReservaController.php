<?php

namespace App\Http\Controllers;

use App\Providers\AutenticacaoService;
use App\Providers\ReservaService;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function getUserReservations(Request $request)
    {

        $params = $request->input();

        if(!isset($params["userId"]) || !isset($params["userToken"])){
            return json_encode([
                "status" => false,
                "mensagem" => "Dados incompletos"
            ]);
        };//return dados icompletos se não tiver as variáveis userId e userToken

        if (!AutenticacaoService::verifyToken($params["userId"], $params["userToken"]))
            return json_encode([
                "status" => false,
                "mensagem" => "Usuário não autenticado"
            ]); //se o token inserido não for o do usuário, retorna null


        $reservas = ReservaService::getReservasByUserId($params["userId"]);
        
        return json_encode([
            "status" => true,
            "obj" => $reservas
        ]);
    }

    public function getUserReservationsQtd(Request $request)
    {
        $params = $request->input();

        if(!isset($params["userId"]) || !isset($params["userToken"]) || !isset($params["qtd"])){
            return json_encode([
                "status" => false,
                "mensagem" => "Dados incompletos"
            ]);
        };//return dados icompletos se não tiver as variáveis userId e userToken

        if(!isset($params["offset"])){
            $params["offset"] = 0;
        }

        if (!AutenticacaoService::verifyToken($params["userId"], $params["userToken"]))
        return json_encode([
            "status" => false,
            "mensagem" => "Usuário não autenticado"
        ]); //se o token inserido não for o do usuário, retorna null


        $reservas = ReservaService::getQtdReservasByUserId($params["userId"], $params["offset"], $params["qtd"]);

        return json_encode([
            "status" => true,
            "obj" => $reservas
        ]);
    }


    public function reservarQuarto(Request $request)
    {

        $params = $request->input();

        if (!(isset($params["idQuarto"]) && isset($params["dataEntrada"]) && isset($params["dataSaida"]) && isset($params["usuarioId"]) && isset($params["usuarioToken"])))
            return json_encode([
                "status" => false,
                "mensagem" => "Dados incompletos"
            ]);
        return json_encode(ReservaService::reservarQuarto($params["idQuarto"], $params["dataEntrada"], $params["dataSaida"], $params["usuarioId"], $params["usuarioToken"]));
    }
}
