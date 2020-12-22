<?php

namespace App\Providers;

use App\Models\Usuario;
use App\Models\UsuarioDAO;
use App\Models\Reserva;

use Illuminate\Support\ServiceProvider;

use function PHPSTORM_META\type;

class UsuarioService extends ServiceProvider
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

    public static function cadastrarUsuario($nome, $email, $senha){

        //envia os dados para o servico de pagamento
        //$result = serviçoDePagamento.cadastrar($dados);
        
        $usuarioCad = UsuarioDAO::getByEmail($email);

        if(!is_null($usuarioCad)) //Se ja tiver usuário ja cadastrado, retorna null
            return json_encode([
                "status" => false,
                "mensagem" => "Uma conta já foi cadastrada com esse e-mail!"
            ]);
        
        if(UsuarioDAO::insert($nome, $email, $senha) > 0){ //se o id retornado foi maior que 0 - usuario cadastrado com sucesso
            return json_encode([
                "status" => true,
                "mensagem" => "Cadastro realizado com sucesso!"
            ]);;
        }
        return json_encode([
            "status" => false,
            "mensagem" => "Ocorreu um erro inesperado!"
        ]);;
    }
    public static function getByEmail($email){
        if($email != ""){
            $usuario = UsuarioDAO::getByEmail($email);
            if(!is_null($usuario))
                return json_encode(get_object_vars($usuario));
        }
        return json_encode(null);
    }
   
    public static function getUsuarioById($id){
        return UsuarioDAO::findById($id);
    }
}
