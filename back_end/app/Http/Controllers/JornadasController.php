<?php

namespace App\Http\Controllers;

use App\Models\Jornadas;
use Illuminate\Http\Request;

class JornadasController extends Controller
{
    public function index()
    {


        $jornadas = Jornadas::all();
        return response()->json($jornadas);
    }

    public function show($id)
    {
        $jornada = Jornadas::find($id);
        return response()->json($jornada);
    }

    public function store(Request $request)
    {
        $jornada = Jornadas::create($request->all());
        return response()->json($jornada, 201);
    }

    public function update(Request $request, $id)
    {
        $jornada = Jornadas::findOrFail($id);
        $jornada->update($request->all());
        return response()->json($jornada, 200);
    }

    public function delete($id)
    {
        Jornadas::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
