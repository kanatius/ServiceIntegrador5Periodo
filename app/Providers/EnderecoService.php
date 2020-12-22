<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Estabelecimento;
use App\Models\Endereco;
use App\Models\EnderecoDAO;
use App\Providers\EstabelecimentoService;

class EnderecoService extends ServiceProvider
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

    public static function getEnderecoById($id){
        return EnderecoDAO::findById($id);
    }
    public static function getEnderecosByCidade($cidade){
        return EnderecoDAO::getEnderecosByCidade($cidade);
    }
    
    // public static function registerEndereco(Endereco $endereco){
    //     return EnderecoDAO::insert($endereco);
    // }
    // public static function registerAllEnderecos(Endereco $enderecos){
    //     return EnderecoDAO::insertAll($enderecos);
    // }
    // public static function removeEndereco(Endereco $endereco){
    //     return EnderecoDAO::remove($endereco);
    // }
    // public static function removeAllEnderecos(Endereco $enderecos){
    //     return EnderecoDAO::removeAll($enderecos);
    // }
}
