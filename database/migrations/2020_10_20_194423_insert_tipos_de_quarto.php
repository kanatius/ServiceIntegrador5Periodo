<?php

use App\Models\TipoDeQuartoDAO;
use App\Providers\TipoDeQuartoService;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InsertTiposDeQuarto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        $normal = TipoDeQuartoService::getNormal();
        $vip = TipoDeQuartoService::getVip();

        TipoDeQuartoDAO::insertAll([$normal, $vip]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table("tipo_de_quarto")->where("id", "<=", 2)->delete();
    }
}
