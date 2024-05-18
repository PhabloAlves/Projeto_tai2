<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Funcionarios;
use Illuminate\Http\Request;

class FuncionariosController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionarios::all();
        return response()->json($funcionarios);
    }

    public function show($id)
    {
        $funcionario = Funcionarios::find($id);
        return response()->json($funcionario);
    }

    public function store(Request $request)
    {
        $funcionario = Funcionarios::create($request->all());
        return response()->json($funcionario, 201);
    }

    public function update(Request $request, $id)
    {
        $funcionario = Funcionarios::findOrFail($id);
        $funcionario->update($request->all());
        return response()->json($funcionario, 200);
    }

    public function delete($id)
    {
        Funcionarios::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
