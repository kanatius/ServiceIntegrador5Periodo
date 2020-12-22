<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TipoDeEstabelecimentoDAO extends Model
{
    //-------------- GET --------------//
    public static function findById($id){ 
        return DB::table("tipo_de_estabelecimento")->select("id", "nome")->where("id", $id)->first();
    }

    public static function getAll(){
        return  DB::table("tipo_de_estabelecimento")->get();
    }
    //-------------- GET --------------//

    //-------------- INSERT --------------//
    public static function insert($tipoDeEstabelecimento){
        $dados = [
            "nome" => $tipoDeEstabelecimento->nome,
            "created_at" => Carbon::now(),
            "updated_at" => null
        ];
        if($tipoDeEstabelecimento->id > 0)
            $dados["id"] = $tipoDeEstabelecimento->id;

        return DB::table("tipo_de_estabelecimento")->insert($dados);
    }

    public static function insertAll($tiposDeEstabelecimento){
        $ids = [];
        foreach($tiposDeEstabelecimento as $tipo){
            $ids[count($ids)] = TipoDeEstabelecimentoDAO::insert($tipo);
        }
        return $ids;

    }
    //-------------- INSERT --------------//

    //-------------- UPDATE --------------//
    public static function update_(TipoDeEstabelecimento $tipoDeEstabelecimento){
        return DB::table("tipo_de_estabelecimento")->where("id", $tipoDeEstabelecimento->getId())->update([
            "nome" => $tipoDeEstabelecimento->getNome(),
            "updated_at" => Carbon::now()
        ]);
    }
    public static function updateAll($tiposDeEstabelecimento){
        $results = [];
        foreach($tiposDeEstabelecimento as $tipo){
            $results[count($results)] = TipoDeEstabelecimentoDAO::update_($tipo);
        }
        return $results;
    }
    //-------------- UPDATE --------------//

     //-------------- ADAPTER --------------//
    //  private static function convertRowToObj($row){
    //     if(!is_null($row))
    //         return new TipoDeEstabelecimento($row->id, $row->nome);
    //     return null;
    // }
    // private static function convertRowsToVectorOfObj($rows){
    //     $tipos = [];
    //     foreach($rows as $row){
    //         $tipos[count($tipos)] = TipoDeEstabelecimentoDAO::convertRowToObj($row);
    //     }
    //     return $tipos;
    // }
    //-------------- ADAPTER --------------//
}
