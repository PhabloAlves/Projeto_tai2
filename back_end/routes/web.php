<?php

use Illuminate\Support\Facades\Route;

// Rotas para users
Route::get('/users', 'App\Http\Controllers\UsersController@index');
Route::post('/users', 'App\Http\Controllers\UsersController@store');
Route::get('/users/{user}', 'App\Http\Controllers\UsersController@show');
Route::put('/users/{user}', 'App\Http\Controllers\UsersController@update');
Route::delete('/users/{user}', 'App\Http\Controllers\UsersController@destroy');

// Rotas para empresas
Route::get('/empresas', 'App\Http\Controllers\EmpresasController@index');
Route::post('/empresas', 'App\Http\Controllers\EmpresasController@store');
Route::get('/empresas/{empresa}', 'App\Http\Controllers\EmpresasController@show');
Route::put('/empresas/{empresa}', 'App\Http\Controllers\EmpresasController@update');
Route::delete('/empresas/{empresa}', 'App\Http\Controllers\EmpresasController@destroy');

// Rotas para funcionários
Route::get('/funcionarios', 'App\Http\Controllers\FuncionariosController@index');
Route::post('/funcionarios', 'App\Http\Controllers\FuncionariosController@store');
Route::get('/funcionarios/{funcionario}', 'App\Http\Controllers\FuncionariosController@show');
Route::put('/funcionarios/{funcionario}', 'App\Http\Controllers\FuncionariosController@update');
Route::delete('/funcionarios/{funcionario}', 'App\Http\Controllers\FuncionariosController@destroy');

// Rotas para serviços
Route::get('/servicos', 'App\Http\Controllers\ServicosController@index');
Route::post('/servicos', 'App\Http\Controllers\ServicosController@store');
Route::get('/servicos/{servico}', 'App\Http\Controllers\ServicosController@show');
Route::put('/servicos/{servico}', 'App\Http\Controllers\ServicosController@update');
Route::delete('/servicos/{servico}', 'App\Http\Controllers\ServicosController@destroy');

// Rotas para agendamentos
Route::get('/agendamentos', 'App\Http\Controllers\AgendamentosController@index');
Route::post('/agendamentos', 'App\Http\Controllers\AgendamentosController@store');
Route::get('/agendamentos/{agendamento}', 'App\Http\Controllers\AgendamentosController@show');
Route::put('/agendamentos/{agendamento}', 'App\Http\Controllers\AgendamentosController@update');
Route::delete('/agendamentos/{agendamento}', 'App\Http\Controllers\AgendamentosController@destroy');

// Rotas para categorias de serviços
Route::get('/categorias-servicos', 'App\Http\Controllers\CategoriasServicosController@index');
Route::post('/categorias-servicos', 'App\Http\Controllers\CategoriasServicosController@store');
Route::get('/categorias-servicos/{categoria_servico}', 'App\Http\Controllers\CategoriasServicosController@show');
Route::put('/categorias-servicos/{categoria_servico}', 'App\Http\Controllers\CategoriasServicosController@update');
Route::delete('/categorias-servicos/{categoria_servico}', 'App\Http\Controllers\CategoriasServicosController@destroy');

// Rotas para jornadas
Route::get('/jornadas', 'App\Http\Controllers\JornadasController@index');
Route::post('/jornadas', 'App\Http\Controllers\JornadasController@store');
Route::get('/jornadas/{jornada}', 'App\Http\Controllers\JornadasController@show');
Route::put('/jornadas/{jornada}', 'App\Http\Controllers\JornadasController@update');
Route::delete('/jornadas/{jornada}', 'App\Http\Controllers\JornadasController@destroy');

// Rotas para serviços-funcionários
Route::get('/servicos-funcionarios', 'App\Http\Controllers\ServicosFuncionariosController@index');
Route::post('/servicos-funcionarios', 'App\Http\Controllers\ServicosFuncionariosController@store');
Route::get('/servicos-funcionarios/{servico_funcionario}', 'App\Http\Controllers\ServicosFuncionariosController@show');
Route::put('/servicos-funcionarios/{servico_funcionario}', 'App\Http\Controllers\ServicosFuncionariosController@update');
Route::delete('/servicos-funcionarios/{servico_funcionario}', 'App\Http\Controllers\ServicosFuncionariosController@destroy');

// Rotas para textos
Route::get('/textos', 'App\Http\Controllers\TextosController@index');
Route::post('/textos', 'App\Http\Controllers\TextosController@store');
Route::get('/textos/{texto}', 'App\Http\Controllers\TextosController@show');
Route::put('/textos/{texto}', 'App\Http\Controllers\TextosController@update');
Route::delete('/textos/{texto}', 'App\Http\Controllers\TextosController@destroy');

// Rotas para views
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
