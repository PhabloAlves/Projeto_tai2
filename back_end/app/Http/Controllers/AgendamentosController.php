<?php

namespace App\Http\Controllers;

use App\Models\Agendamentos;
use App\Models\Servicos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AgendamentosController extends Controller
{
    public function index()
    {
        return view('site.agendamentos.index');

        // $agendamentos = Agendamentos::all();
        // return response()->json($agendamentos);
    }

    public function index_by_user()
{
    $userId = Auth::id();
    $agendamentos = Agendamentos::where('users_id', $userId)->get();
    $agendamentosFormatados = [];

 
    foreach ($agendamentos as $agendamento) {
        $servico = Servicos::find($agendamento->servicos_id);
        $agendamentoFormatado = [
            'Data' => $agendamento->data->format('Y-m-d H:i:s'), // Formatando a data adequadamente
            'Cliente' => $agendamento->nome_cliente, // Supondo que você tenha um campo 'nome_cliente'
            'Nome' => $servico ? $servico->nome_servico : 'Serviço não encontrado',
            'Status' => $agendamento->status,
            'Valor' => $servico ? $servico->valor : 0,
        ];

        $agendamentosFormatados[] = $agendamentoFormatado;
    }

    return response()->json($agendamentosFormatados);
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
