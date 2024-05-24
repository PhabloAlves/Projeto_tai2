<?php

use Illuminate\Support\Facades\Route;

    // Rotas para userss
    Route::get('/users', 'UsersController@index');
    Route::post('users', [UsersController::class, 'store']);
    Route::get('users/{users}', [usersController::class, 'show']);
    Route::put('users/{users}', [usersController::class, 'update']);
    Route::delete('users/{users}', [usersController::class, 'destroy']);

    // Rotas para empresass
    Route::get('/empresas', [EmpresasController::class, 'index']);
    Route::post('empresas', [empresasController::class, 'store']);
    Route::get('empresas/{empresas}', [empresasController::class, 'show']);
    Route::put('empresas/{empresas}', [empresasController::class, 'update']);
    Route::delete('empresas/{empresas}', [empresasController::class, 'destroy']);

    // Rotas para Funcionarioss
    Route::get('Funcionarioss', [FuncionariosController::class, 'index']);
    Route::post('Funcionarioss', [FuncionariosController::class, 'store']);
    Route::get('Funcionarioss/{Funcionarios}', [FuncionariosController::class, 'show']);
    Route::put('Funcionarioss/{Funcionarios}', [FuncionariosController::class, 'update']);
    Route::delete('Funcionarioss/{Funcionarios}', [FuncionariosController::class, 'destroy']);

    // Rotas para Servicoss
    Route::get('Servicoss', [ServicosController::class, 'index']);
    Route::post('Servicoss', [ServicosController::class, 'store']);
    Route::get('Servicoss/{Servicos}', [ServicosController::class, 'show']);
    Route::put('Servicoss/{Servicos}', [ServicosController::class, 'update']);
    Route::delete('Servicoss/{Servicos}', [ServicosController::class, 'destroy']);

    // Rotas para Agendamentoss
    Route::get('Agendamentoss', [AgendamentosController::class, 'index']);
    Route::post('Agendamentoss', [AgendamentosController::class, 'store']);
    Route::get('Agendamentoss/{Agendamentos}', [AgendamentosController::class, 'show']);
    Route::put('Agendamentoss/{Agendamentos}', [AgendamentosController::class, 'update']);
    Route::delete('Agendamentoss/{Agendamentos}', [AgendamentosController::class, 'destroy']);

    // Rotas para Categoriass de Servicoss
    Route::get('Categoriass-Servicoss', [CategoriasServicosController::class, 'index']);
    Route::post('Categoriass-Servicoss', [CategoriasServicosController::class, 'store']);
    Route::get('Categoriass-Servicoss/{Categorias_Servicos}', [CategoriasServicosController::class, 'show']);
    Route::put('Categoriass-Servicoss/{Categorias_Servicos}', [CategoriasServicosController::class, 'update']);
    Route::delete('Categoriass-Servicoss/{Categorias_Servicos}', [CategoriasServicosController::class, 'destroy']);

    // Rotas para Jornadass
    Route::get('Jornadass', [JornadasController::class, 'index']);
    Route::post('Jornadass', [JornadasController::class, 'store']);
    Route::get('Jornadass/{Jornadas}', [JornadasController::class, 'show']);
    Route::put('Jornadass/{Jornadas}', [JornadasController::class, 'update']);
    Route::delete('Jornadass/{Jornadas}', [JornadasController::class, 'destroy']);

    // Rotas para Servicoss Funcionarioss
    Route::get('Servicos-Funcionarioss', [ServicosFuncionariosController::class, 'index']);
    Route::post('Servicos-Funcionarioss', [ServicosFuncionariosController::class, 'store']);
    Route::get('Servicos-Funcionarioss/{Servicos_Funcionarios}', [ServicosFuncionariosController::class, 'show']);
    Route::put('Servicos-Funcionarioss/{Servicos_Funcionarios}', [ServicosFuncionariosController::class, 'update']);
    Route::delete('Servicos-Funcionarioss/{Servicos_Funcionarios}', [ServicosFuncionariosController::class, 'destroy']);

    // Rotas para Textos
    Route::get('textos', [TextosController::class, 'index']);
    Route::post('textos', [TextosController::class, 'store']);
    Route::get('textos/{texto}', [TextosController::class, 'show']);
    Route::put('textos/{texto}', [TextosController::class, 'update']);
    Route::delete('textos/{texto}', [TextosController::class, 'destroy']);



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
