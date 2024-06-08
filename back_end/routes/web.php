<?php

use Illuminate\Support\Facades\Route;

//agenda
Route::get('/agendas', 'App\Http\Controllers\AgendasController@index');

// Rotas para users
Route::get('/users', 'App\Http\Controllers\UsersController@index');
Route::get('/users_dados', 'App\Http\Controllers\UsersController@show_dados');
Route::post('/users', 'App\Http\Controllers\UsersController@store');
Route::get('/users/{user}', 'App\Http\Controllers\UsersController@show');
Route::put('/users/{user}', 'App\Http\Controllers\UsersController@update');
Route::delete('/users/{user}', 'App\Http\Controllers\UsersController@destroy');

// Rotas para empresas
Route::get('/empresas', 'App\Http\Controllers\EmpresasController@index');
Route::post('/empresas', 'App\Http\Controllers\EmpresasController@store')->name('empresas.store');
Route::put('/empresas/{id}', 'App\Http\Controllers\EmpresasController@update')->name('empresas.update');

// Rotas para funcionários
Route::get('/funcionarios', 'App\Http\Controllers\FuncionariosController@index')->name('funcionarios.index');
Route::get('/funcionarios/create/{id?}', 'App\Http\Controllers\FuncionariosController@create')->name('funcionarios.create');
Route::post('/funcionarios', 'App\Http\Controllers\FuncionariosController@store')->name('funcionarios.store');
Route::put('/funcionarios/{id}', 'App\Http\Controllers\FuncionariosController@update')->name('funcionarios.update');
Route::delete('/funcionarios/{id}', 'App\Http\Controllers\FuncionariosController@delete')->name('funcionarios.delete');

// Rotas para serviços
Route::get('/servicos', 'App\Http\Controllers\ServicosController@index');
Route::post('/servicos', 'App\Http\Controllers\ServicosController@store');
Route::get('/servicos/{servico}', 'App\Http\Controllers\ServicosController@show');
Route::put('/servicos/{servico}', 'App\Http\Controllers\ServicosController@update');
Route::delete('/servicos/{servico}', 'App\Http\Controllers\ServicosController@delete');

// Rotas para agendamentos
Route::get('/agendamento', 'App\Http\Controllers\AgendamentosController@index');
Route::get('/agendamento_user', 'App\Http\Controllers\AgendamentosController@index_by_user');
Route::post('/agendamento', 'App\Http\Controllers\AgendamentosController@store');
Route::get('/agendamento/{agendamento}', 'App\Http\Controllers\AgendamentosController@show');
Route::put('/agendamento/{agendamento}', 'App\Http\Controllers\AgendamentosController@update');
Route::delete('/agendamento/{agendamento}', 'App\Http\Controllers\AgendamentosController@destroy');

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

// Rotas para textos
Route::get('/textos', 'App\Http\Controllers\TextosController@index');
Route::post('/textos', 'App\Http\Controllers\TextosController@store');
Route::get('/textos/{texto}', 'App\Http\Controllers\TextosController@show');
Route::put('/textos/{texto}', 'App\Http\Controllers\TextosController@update');
Route::delete('/textos/{texto}', 'App\Http\Controllers\TextosController@destroy');

// Rotas para views
Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/configuracoes', function () {
    return view('configuracoes');
});

Route::get('/ajuda', function () {
    return view('ajuda');
});
