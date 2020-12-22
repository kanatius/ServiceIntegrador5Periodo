<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Quarto;
use App\Models\QuartoDAO;
use App\Models\Reserva;
use App\Models\Estabelecimento;

class QuartoService extends ServiceProvider
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

    
    public static function getQuatoById($id){
        return QuartoDAO::findById($id);
    }

    public static function registerAllQuartos($quartos){
        return QuartoDAO::insertAll($quartos);
    }
    public static function getValorQuartoPousadaNormal(){
       return 150;
    }
    public static function getValorQuartoPousadaVIP(){
        return 250;
    }
    public static function getValorQuartoHotelNormal(){
        return 300;
    }
    public static function getValorQuartoHotelVIP(){
        return 500;
    }

    public static function getQuartosByIdEstabelecimento($idEstabelecimento){
        $quartos = QuartoDAO::getQuartosByIdEstabelecimento($idEstabelecimento);
        return $quartos;
    }
}
