<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/agendamentos-filtro', 'App\Http\Controllers\AgendamentosController@filtros');
Route::post('/funcionarios-filtro', 'App\Http\Controllers\FuncionariosController@filtros');
Route::post('/jornadas-filtro', 'App\Http\Controllers\JornadasController@filtros');

//Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::put('/agendamentos-status/{id}', 'App\Http\Controllers\AgendamentosController@updateStatus');