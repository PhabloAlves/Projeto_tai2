<?php

namespace App\Http\Controllers;

use App\Models\Agendamentos;
use Illuminate\Http\Request;

class AgendamentosController extends Controller
{
    public function index()
    {
        return view('site.agendamentos.index');

        // $agendamentos = Agendamentos::all();
        // return response()->json($agendamentos);
    }

    public function show($id)
    {
        $agendamento = Agendamentos::find($id);
        return response()->json($agendamento);
    }

    public function store(Request $request)
    {
        $agendamento = Agendamentos::create($request->all());
        return response()->json($agendamento, 201);
    }

    public function update(Request $request, $id)
    {
        $agendamento = Agendamentos::findOrFail($id);
        $agendamento->update($request->all());
        return response()->json($agendamento, 200);
    }

    public function delete($id)
    {
        Agendamentos::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
