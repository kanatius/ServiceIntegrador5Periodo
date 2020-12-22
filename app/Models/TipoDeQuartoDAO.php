<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TipoDeQuartoDAO extends Model
{
    //-------------- GET --------------//
    public static function findById($id){
        return DB::table("tipo_de_quarto")->select("id", "nome")->where("id", $id)->first();
    }
    public static function getAll(){
        return DB::table("tipo_de_quarto")->get();
    }
    //-------------- GET --------------//

    //-------------- INSERT --------------//
    public static function insert($tipoDeQuarto){
        $dados = [
            "nome" => $tipoDeQuarto->nome, 
            "created_at" => Carbon::now(), 
            "updated_at" => null
        ];
        if($tipoDeQuarto->id > 0)
            $dados["id"] = $tipoDeQuarto->id;

        return DB::table("tipo_de_quarto")->insertGetId($dados);
    }
    public static function insertAll($tiposDeQuarto){
        $ids = [];
        foreach($tiposDeQuarto as $tipo){
            $ids[count($ids)] = TipoDeQuartoDAO::insert($tipo);
        }
        return $ids;
    }
    //-------------- INSERT --------------//

   //-------------- UPADTE --------------//
    public static function update_(TipoDeQuarto $tipoDeQuarto){
        return DB::table("tipo_de_quarto")->where("id", $tipoDeQuarto->getId())->update([
            "nome" => $tipoDeQuarto->getNome(),
            "updated_at" => Carbon::now()
        ]);
    }
    public static function updateAll($tiposDeQuarto){
        $results = [];
        foreach($tiposDeQuarto as $tipoDeQuarto){
            $results[count($results)] = TipoDeQuartoDAO::update_($tipoDeQuarto);
        }
        return $results;
    }
    //-------------- UPADTE --------------//

    //-------------- ADAPTER --------------//
    // private static function convertRowToObj($row){
    //     if(!is_null($row))
    //         return new TipoDeQuarto($row->id, $row->nome);
    //     return null;
    // }
    // private static function convertRowsToVectorOfObj($rows){
    //     $tipos = [];
    //     foreach($rows as $row){
    //         $tipos[count($tipos)] = TipoDeQuartoDAO::convertRowToObj($row);
    //     }
    //     return $tipos;
    // }
    //-------------- ADAPTER --------------//
}
