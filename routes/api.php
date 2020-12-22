<?php

use App\Http\Controllers\EstabelecimentoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ReservaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/login", [UsuarioController::class, 'getUser']);

Route::post("/reservas", [ReservaController::class, 'getUserReservations']);

Route::post("/reservasQtd", [ReservaController::class, 'getUserReservationsQtd']);

Route::post("/cadastrarUsuario", [UsuarioController::class, "cadastrarUsuario"]);

Route::get("/buscarEstabelecimentosDisponiveis", [EstabelecimentoController::class, "buscarEstabelecimentosDisponiveis"]);

Route::get("/quartosDisponiveis", [EstabelecimentoController::class, "getQuartosDisponiveis"]);

Route::post("/reservarQuarto", [ReservaController::class, "reservarQuarto"]);

Route::get("/getInfoEstabelecimento", [EstabelecimentoController::class, "getInfoEstabelecimento"]);

Route::get("/getInfoEstabelecimentos", [EstabelecimentoController::class, "getInfoEstabelecimentos"]);
