<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Empresas;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    public function index()
    {
        $empresas = Empresas::all();
        return response()->json($empresas);
    }

    public function show($id)
    {
        $empresa = Empresas::find($id);
        return response()->json($empresa);
    }

    public function store(Request $request)
    {
        $empresa = Empresas::create($request->all());
        return response()->json($empresa, 201);
    }

    public function update(Request $request, $id)
    {
        $empresa = Empresas::findOrFail($id);
        $empresa->update($request->all());
        return response()->json($empresa, 200);
    }

    public function delete($id)
    {
        Empresas::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
