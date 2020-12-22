<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class EnderecoDAO extends Model
{
     //-------------- GET --------------//
     public static function findById($id){
        return DB::table("endereco")->select("id", "rua", "numero", "bairro", "cidade", "estado")->where("id", $id)->first();
    }

    public static function getAll(){
        return DB::table("endereco")->get();
    }
    public static function getEnderecosByCidade($cidade){
        return DB::table("endereco")->select("id", "rua", "numero", "bairro", "cidade", "estado")->whereRaw("lower(cidade) like (?)", ("%" . strtolower($cidade) . "%"))->get();
    }
    //-------------- GET --------------//

    //-------------- INSERT --------------//
    public static function insert(Endereco $endereco){
        $dados = [
            "rua" => $endereco->getRua(), 
            "numero" => $endereco->getNumero(), 
            "bairro" => $endereco->getBairro(), 
            "cidade" => $endereco->getCidade(), 
            "estado" => $endereco->getEstado(), 
            "created_at" => Carbon::now(), 
            "updated_at" => null
        ];
        if($endereco->getId() > 0){
            $dados["id"] = $endereco->getId();
        }
        return DB::table("endereco")->insertGetId($dados);
    }

    public static function insertAll($enderecos){
        $ids = [];
        foreach($enderecos as $endereco){
            $ids[count($ids)] = EnderecoDAO::insert($endereco);
        }
        return $ids;
    }
    //-------------- INSERT --------------//

    //-------------- UPDATE --------------//
    public static function update_(Endereco $endereco){
        $dataEHoraAtual = Carbon::now()->format("d/m/Y H:i:s");
        return DB::table("endereco")->where($endereco->getId())->update([
            "id" => $endereco->getId(), 
            "rua" => $endereco->getRua(), 
            "numero" => $endereco->getNumero(), 
            "bairro" => $endereco->getBairro(), 
            "cidade" => $endereco->getCidade(), 
            "estado" => $endereco->getEstado(), 
            "updated_at" => $dataEHoraAtual]);
    }
    public static function updateAll($enderecos){
        $ids = [];
        foreach($enderecos as $endereco){
            $ids[count($ids)] = EnderecoDAO::update_($endereco);
        }
        return $ids;
    }
    //-------------- UPDATE --------------//

    //-------------- REMOVE--------------//
    public static function remove(Endereco $endereco){
        return DB::table("endereco")->where("id", $endereco->getId())->delete();
    }
    public static function removeAll($enderecos){
        $results = [];
        foreach($enderecos as $endereco){
            EnderecoDAO::remove($endereco);
        }
        return $results;
    }
    //-------------- REMOVE--------------//


    //-------------- ADAPTER --------------//
    // private static function convertRowToObj($row){
    //     if(!is_null($row))
    //         return new Endereco($row->id, $row->rua, $row->numero, $row->bairro, $row->cidade, $row->estado);
    //     return null;
    // }
    // private static function convertRowsToVectorOfObj($rows){
    //     $quartos = [];
    //     foreach($rows as $row){
    //         $quartos[count($quartos)] = EnderecoDAO::convertRowToObj($row);
    //     }
    //     return $quartos;
    // }
    //-------------- ADAPTER --------------//
}
