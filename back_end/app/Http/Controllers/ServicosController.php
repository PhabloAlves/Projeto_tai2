<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use App\Models\Servicos;
use Illuminate\Http\Request;

class ServicosController extends Controller
{
    public function index()
    {
        $servicos = Servicos::all();
        return response()->json($servicos);
    }

    public function show($id)
    {
        $servico = Servicos::find($id);
        return response()->json($servico);
    }

    public function store(Request $request)
    {
        $servico = Servicos::create($request->all());
        return response()->json($servico, 201);
    }

    public function update(Request $request, $id)
    {
        $servico = Servicos::findOrFail($id);
        $servico->update($request->all());
        return response()->json($servico, 200);
    }

    public function delete($id)
    {
        Servicos::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
