<?php

namespace App\Providers;

use App\Models\TipoDeEstabelecimentoDAO;

use Illuminate\Support\ServiceProvider;
use stdClass;

class TipoDeEstabelecimentoService extends ServiceProvider
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

    public static function getPousada(){
        $te = new stdClass;
        $te->id = 1;
        $te->nome = "Pousada";
        return $te;
    }
    public static function getHotel(){
        $te = new stdClass;
        $te->id = 2;
        $te->nome = "Hotel";
        return $te;
    }
    public static function getTipoDeEstabelecimentoById($id){
        return TipoDeEstabelecimentoDAO::findById($id);
    }
}
