<?php

use App\Providers\TipoDeEstabelecimentoService;
use App\Models\TipoDeEstabelecimentoDAO;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InsertTipoDeEstabelecimento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $pousada = TipoDeEstabelecimentoService::getPousada();
        $hotel = TipoDeEstabelecimentoService::getHotel();
        TipoDeEstabelecimentoDAO::insertAll([$pousada, $hotel]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table("tipo_de_estabelecimento")->where("id", "<=", 2)->delete();
    }
}
