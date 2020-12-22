<?php

namespace App\Http\Controllers;

use App\Providers\UsuarioService;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    //

    public function getUser(Request $request){
        $params = $request->input();

        if(!(isset($params['email']) && isset($params['senha']))){
            return "Dados incompletos";
        }
        return UsuarioService::getByEmail($params['email']); 
    }

    public function cadastrarUsuario(Request $request){

        $params = $request->input();

        if(!(isset($params["nome"]) && isset($params["email"]) && isset($params["senha"])))
            return false; //se tiver algum dado faltando, retorna false

        return json_encode(UsuarioService::cadastrarUsuario($params["nome"], $params["email"], $params["senha"]));
    }
}
