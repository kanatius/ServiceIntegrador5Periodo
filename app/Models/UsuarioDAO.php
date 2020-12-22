<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UsuarioDAO extends Model
{
    //-------------- GET --------------//
    public static function findById($id)
    {
        return DB::table("usuario")->select("id", "nome", "token", "email")->where("id", $id)->first();
    }

    public static function getAll()
    {
        return DB::table("usuario")->get();
    }

    // public static function getByNameLikesTo($nome){
    //     $rows = DB::table("usuario")->whereRaw("lower(nome) like (?)", ('%' . $nome . "%"))->get();
    //     $usuarios = [];
    //     foreach($rows as $row){
    //         $usuarios[count($usuarios)] = new Usuario($row->id, $row->nome, $row->email);
    //     }
    //     return $usuarios;
    // }
    public static function getByEmail($email)
    {
        return DB::table("usuario")->select("id", "nome", "token", "email")->whereRaw("lower(email) = (?)", strtolower($email))->first();
    }
    //-------------- GET --------------//

    //-------------- INSERT --------------//
    public static function insert($nome, $email, $senha)
    {
        $dados = [
            "nome" => $nome, 
            "email" => $email,
            "token" => Str::random(50), //gera um token aleatorio para o usuario //esse token deveria vir do serviço de pagamento
            "created_at" => Carbon::now(), 
            "updated_at" => null
        ];
        return DB::table("usuario")->insertGetId($dados);
    }

    public static function insertAll($usuarios)
    {
        $ids = [];
        foreach($usuarios as $usuario){
            $tamanho = count($ids);
            $ids[$tamanho] = UsuarioDAO::insert($usuario["nome"], $usuario["email"], $usuario["senha"]);
        }
        return $ids;
    }
    //-------------- INSERT --------------//

    //-------------- UPDATE --------------//
    // public static function update_(Usuario $usuario)
    // {
    //     return DB::table("usuario")->where("id", $usuario->getId())->update([
    //         "nome" => $usuario->getNome(), 
    //         "email" => $usuario->getEmail(), 
    //         "updated_at" => Carbon::now()
    //     ]);
    // }
    // public static function updateAll($usuarios)
    // {
    //     $results = [];
    //     foreach($usuarios as $usuario){
    //         $results[count($results)] = UsuarioDAO::update_($usuario);
    //     }
    //     return $results;
    // }
    //-------------- UPDATE --------------//

    //-------------- REMOVE--------------//
    
    //-------------- REMOVE--------------//


    //-------------- ADAPTER --------------//
    // private static function convertRowToObj($row){
    //     if(!is_null($row)){
    //         $usuario = new Usuario($row->id, $row->nome, $row->email);
    //         $usuario->setToken($row->token);
    //         return $usuario;
    //     }
    //     return null;
    // }
    // private static function convertRowsToVectorOfObj($rows){
    //     $usuarios = [];
    //     foreach($rows as $row){
    //         $usuarios[count($usuarios)] = UsuarioDAO::convertRowToObj($row);
    //     }
    //     return $usuarios;
    // }
    //-------------- ADAPTER --------------//
}
