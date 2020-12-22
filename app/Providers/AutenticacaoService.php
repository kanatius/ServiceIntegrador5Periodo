<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AutenticacaoService extends ServiceProvider
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

    public static function verifyToken($userId, $userToken){
        $userBD = UsuarioService::getUsuarioById($userId);
        if(!is_null($userBD))
            return ($userToken == $userBD->token) ? true : false; //retorna true se o token inserido for igual ao que consta no banco
        return false;
    }
}
