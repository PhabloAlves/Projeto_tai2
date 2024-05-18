<?php

namespace App\Http\Controllers;

use App\Models\ServicoFuncionario;
use App\Models\ServicosFuncionarios;
use Illuminate\Http\Request;

class ServicosFuncionariosController extends Controller
{
    public function index()
    {
        $servicosFuncionarios = ServicosFuncionarios::all();
        return response()->json($servicosFuncionarios);
    }

    public function show($id)
    {
        $servicoFuncionario = ServicosFuncionarios::find($id);
        return response()->json($servicoFuncionario);
    }

    public function store(Request $request)
    {
        $servicoFuncionario = ServicosFuncionarios::create($request->all());
        return response()->json($servicoFuncionario, 201);
    }

    public function update(Request $request, $id)
    {
        $servicoFuncionario = ServicosFuncionarios::findOrFail($id);
        $servicoFuncionario->update($request->all());
        return response()->json($servicoFuncionario, 200);
    }

    public function delete($id)
    {
        ServicosFuncionarios::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
