<?php

use Illuminate\Support\Facades\Route;

//agenda
Route::get('/agendamentos', 'App\Http\Controllers\agendamentosController@index');

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
Route::get('/funcionarios_dados', 'App\Http\Controllers\FuncionariosController@dados')->name('funcionarios.dados');
Route::get('/funcionarios/create/{id?}', 'App\Http\Controllers\FuncionariosController@create')->name('funcionarios.create');
Route::post('/funcionarios', 'App\Http\Controllers\FuncionariosController@store')->name('funcionarios.store');
Route::put('/funcionarios/{id}', 'App\Http\Controllers\FuncionariosController@update')->name('funcionarios.update');
Route::delete('/funcionarios/{id}', 'App\Http\Controllers\FuncionariosController@delete')->name('funcionarios.delete');

// Rotas para serviços
Route::get('/servicos', 'App\Http\Controllers\ServicosController@index')->name('servicos.index');
Route::get('/servicos/create/{id?}', 'App\Http\Controllers\ServicosController@create')->name('servicos.create');
Route::get('/servicos_dados', 'App\Http\Controllers\ServicosController@dados')->name('servicos.dados');
Route::delete('/servicos/{id}', 'App\Http\Controllers\ServicosController@delete')->name('servicos.delete');
Route::post('/servicos', 'App\Http\Controllers\ServicosController@store')->name('servicos.store');
Route::put('/servicos/{id}', 'App\Http\Controllers\ServicosController@update')->name('servicos.update');

// Rotas para agendamentos
Route::get('/agendamentos', 'App\Http\Controllers\AgendamentosController@index')->name('agendamentos.index');
//Route::post('/agendamentos_filter', 'App\Http\Controllers\AgendamentosController@filter')->name('agendamentos.//');
Route::get('/agendamentos_dados', 'App\Http\Controllers\AgendamentosController@dados')->name('agendamentos.dados');
Route::get('/agendamentos/create/{id?}', 'App\Http\Controllers\AgendamentosController@create')->name('agendamentos.create');
Route::delete('/agendamentos/{id}', 'App\Http\Controllers\AgendamentosController@delete')->name('agendamentos.delete');
Route::post('/agendamentos', 'App\Http\Controllers\AgendamentosController@store')->name('agendamentos.store');
Route::put('/agendamentos/{id}', 'App\Http\Controllers\AgendamentosController@update')->name('agendamentos.update');

// Rotas para categorias de serviços
Route::get('/categoriasservicos', 'App\Http\Controllers\CategoriasServicosController@index')->name('categoriasServicos.index');
Route::get('/categoriasservicos/create/{id?}', 'App\Http\Controllers\CategoriasServicosController@create')->name('categoriasServicos.create');
Route::delete('/categoriasservicos/{id}', 'App\Http\Controllers\CategoriasServicosController@delete')->name('categoriasServicos.delete');
Route::post('/categoriasservicos', 'App\Http\Controllers\CategoriasServicosController@store')->name('categoriasServicos.store');
Route::put('/categoriasservicos/{id}', 'App\Http\Controllers\CategoriasServicosController@update')->name('categoriasServicos.update');

// Rotas para jornadas
Route::get('/jornadas', 'App\Http\Controllers\JornadasController@index')->name('jornadas.index');
Route::get('/jornadas/create/{id?}', 'App\Http\Controllers\JornadasController@create')->name('jornadas.create');
Route::delete('/jornadas/{id}', 'App\Http\Controllers\JornadasController@delete')->name('jornadas.delete');
Route::post('/jornadas', 'App\Http\Controllers\JornadasController@store')->name('jornadas.store');
Route::put('/jornadas/{id}', 'App\Http\Controllers\JornadasController@update')->name('jornadas.update');

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

Route::get('/usuarios', function () {
    return view('site.usuarios.index');
});

Route::get('/agendamentos', function () {
    return view('site.agendamentos.index');
});

Route::get('/categoriaservicos', function () {
    return view('site.categoriasservicos.index');
});

// Route::get('/servicos', function () {
//     return view('site.servicos.index');
// });

// Route::get('/jornadas', function () {
//     return view('site.jornadas.index');
// });

// Route::get('/agendamentos', function () {
//     return view('site.agendamentos.index');
// });

Route::get('/ajuda', function () {
    return view('site.ajuda.index');
});

Route::get('/configuracoes', function () {
    return view('site.configuracoes.index');
});





