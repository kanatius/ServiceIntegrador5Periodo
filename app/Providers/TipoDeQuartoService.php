<?php

namespace App\Providers;

use App\Models\TipoDeQuarto;
use App\Models\TipoDeQuartoDAO;
use App\Models\Quarto;

use Illuminate\Support\ServiceProvider;

class TipoDeQuartoService extends ServiceProvider
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
    public static function getVip(){
        return new TipoDeQuarto(2, "VIP");
    }
    public static function getNormal(){
        return new TipoDeQuarto(1, "Normal");
    }

    public static function getTipoDeQuartoById($id){
        return TipoDeQuartoDAO::findById($id);
    }
}
