<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Texto;

class TextosController extends Controller
{

    public function index()
    {
        $textos = Texto::all();
        return response()->json($textos);
    }


    public function store(Request $request)
    {
        $texto = Texto::create($request->all());
        return response()->json($texto, 201);
    }


    public function show($id)
    {
        $texto = Texto::findOrFail($id);
        return response()->json($texto);
    }


    public function update(Request $request, $id)
    {
        $texto = Texto::findOrFail($id);
        $texto->update($request->all());
        return response()->json($texto, 200);
    }


    public function destroy($id)
    {
        Texto::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
