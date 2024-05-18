<?php

namespace App\Http\Controllers;

use App\Models\CategoriaServico;
use App\Models\CategoriasServicos;
use Illuminate\Http\Request;

class CategoriasServicosController extends Controller
{
    public function index()
    {
        $categorias = CategoriasServicos::all();
        return response()->json($categorias);
    }

    public function show($id)
    {
        $categoria = CategoriasServicos::find($id);
        return response()->json($categoria);
    }

    public function store(Request $request)
    {
        $categoria = CategoriasServicos::create($request->all());
        return response()->json($categoria, 201);
    }

    public function update(Request $request, $id)
    {
        $categoria = CategoriasServicos::findOrFail($id);
        $categoria->update($request->all());
        return response()->json($categoria, 200);
    }

    public function delete($id)
    {
        CategoriasServicos::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
