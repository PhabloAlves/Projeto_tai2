<?php

namespace App\Http\Controllers;

use App\Models\Agendamentos;
use App\Models\Empresas;
use App\Models\Funcionarios;
use App\Models\Jornadas;
use App\Models\Servicos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AgendamentosController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            view()->share('jsFile', 'agendamentos.js');
            return $next($request);
        });
    }

    public function index()
    {
        return view('site.agendamentos.index');
    }

    public function dados()
    {
        $userId = 1; // teste, lembrar de mudar quando login voltar
        $agendamentos = Agendamentos::where('users_id', $userId)->orderBy('data', 'asc')->get();
        $agendamentosFormatados = [];

        foreach ($agendamentos as $agendamento) {
            $servico = Servicos::find($agendamento->servicos_id);
            $funcionario = Funcionarios::find($agendamento->funcionarios_id);
            $agendamentoFormatado = [
                'Data' => $agendamento->data->format('d/m/Y'),
                'hora_inicio' => $agendamento->hora_inicio->format('H:i'),
                'hora_fim' => $agendamento->hora_fim->format('H:i'),
                'Cliente' => $agendamento->nome_cliente, // Supondo que você tenha um campo 'nome_cliente'
                'Nome' => $servico ? $servico->nome_servico : 'Serviço não encontrado',
                'Funcionario' => $funcionario->nome,
                'Status' => $agendamento->status,
                'Valor' => $servico ? $servico->valor : 0,
            ];

            $agendamentosFormatados[] = $agendamentoFormatado;
        }

        return response()->json($agendamentosFormatados);
    }




    // public function index_by_user()
    // {
    //     $userId = 1; //teste, lembrar de mudar quando login voltar
    //     $agendamentos = Agendamentos::where('users_id', $userId)->get();
    //     $agendamentosFormatados = [];


    //     foreach ($agendamentos as $agendamento) {
    //         $servico = Servicos::find($agendamento->servicos_id);
    //         $agendamentoFormatado = [
    //             'Data' => $agendamento->data->format('Y-m-d'),
    //             'hora_inicio' => $agendamento->hora_inicio->format('H:i'),
    //             'hora_fim' => $agendamento->hora_fim->format('H:i'),
    //             'Cliente' => $agendamento->nome_cliente, // Supondo que você tenha um campo 'nome_cliente'
    //             'Nome' => $servico ? $servico->nome_servico : 'Serviço não encontrado',
    //             'Status' => $agendamento->status,
    //             'Valor' => $servico ? $servico->valor : 0,
    //         ];

    //         $agendamentosFormatados[] = $agendamentoFormatado;
    //     }

    //     return response()->json($agendamentosFormatados);
    // }


    public function create($id = null)
    {
        if ($id != null) {
            $agendamento = Agendamentos::findOrFail($id);
            $dataMes = $agendamento->data->format('Y-m-d');
            $horaIni = $agendamento->hora_inicio->format('H:i');
            $horaFim = $agendamento->hora_fim->format('H:i');
            $agendamento = $agendamento->toArray();
            $agendamento['data'] = $dataMes;
            $agendamento['horaInicio'] = $horaIni;
            $agendamento['horaFim'] = $horaFim;
        } else {
            $agendamento = new Agendamentos();
        }

        $idusuario = 1; //teste, lembrar de mudar quando login voltar
        $empresa = Empresas::where('users_id', $idusuario)->first();
        $funcionarios = Funcionarios::where('empresas_id', $empresa->id)->get();
        $servicos = Servicos::where('empresas_id', $empresa->id)->get();

        return view('site.agendamentos.form', compact('agendamento', 'funcionarios', 'servicos'));
    }

    public function store(Request $request)
    {
        // $validator = Agendamentos::validate($request->all());

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $empresa = Empresas::where('users_id', 1)->first();
        $postdata = $request->input();

        $data = Carbon::parse($postdata['data']);
        $diaSemana = $data->dayOfWeek; // 0 (Domingo) - 6 (Sábado)

        $jornadasDiaMes = Jornadas::where('funcionarios_id', $postdata['funcionario_id'])
            ->where('diaMes', $postdata['data'])
            ->exists();

        if ($jornadasDiaMes) {
            // Verificar se há jornada na data específica e se o horário é compatível
            $jornadaHorario = Jornadas::where('funcionarios_id', $postdata['funcionario_id'])
                ->where('diaMes', $postdata['data'])
                ->where(function ($query) use ($postdata) {
                    $query->where('horaInicio', '<=', $postdata['horaInicio'])
                        ->where('horaFim', '>=', $postdata['horaFim']);
                })
                ->exists();

            // Verificar se há uma operação de subtração que interfere no horário
            $operacaoSubtracaoDiaMes = Jornadas::where('funcionarios_id', $postdata['funcionario_id'])
                ->where('diaMes', $postdata['data'])
                ->where('operacao', 1) // operação = 1 para subtração
                ->where(function ($query) use ($postdata) {
                    $query->where('horaInicio', '<=', $postdata['horaFim'])
                        ->where('horaFim', '>=', $postdata['horaInicio']);
                })
                ->exists();

            if (!$jornadaHorario || $operacaoSubtracaoDiaMes) {
                return redirect()->back()->with('error', 'Funcionário não possui jornadas de trabalho nesta data e horário!');
            }
        } else {
            // Verificar se existe jornada no dia da semana se não houver no dia específico
            $jornadasDiaSemana = Jornadas::where('funcionarios_id', $postdata['funcionario_id'])
                ->where('diaSemana', 'like', "%$diaSemana%")
                ->exists();

            if ($jornadasDiaSemana) {
                $jornadaHorario = Jornadas::where('funcionarios_id', $postdata['funcionario_id'])
                    ->where('diaSemana', 'like', "%$diaSemana%")
                    ->where(function ($query) use ($postdata) {
                        $query->where('horaInicio', '<=', $postdata['horaInicio'])
                            ->where('horaFim', '>=', $postdata['horaFim']);
                    })
                    ->exists();

                // Verificar se há uma operação de subtração que interfere no horário
                $operacaoSubtracaoDiaSemana = Jornadas::where('funcionarios_id', $postdata['funcionario_id'])
                    ->where('diaSemana', 'like', "%$diaSemana%")
                    ->where('operacao', 1) // operação = 1 para subtração
                    ->where(function ($query) use ($postdata) {
                        $query->where('horaInicio', '<=', $postdata['horaFim'])
                            ->where('horaFim', '>=', $postdata['horaInicio']);
                    })
                    ->exists();

                if (!$jornadaHorario || $operacaoSubtracaoDiaSemana) {
                    return redirect()->back()->with('error', 'Funcionário não possui jornadas de trabalho nesta data e horário!');
                }
            } else {
                return redirect()->back()->with('error', 'Funcionário não possui jornadas de trabalho nesta data e horário!');
            }
        }

        $agendamentosCriados = Agendamentos::where('funcionarios_id', $postdata['funcionario_id'])
            ->where('data', $postdata['data'])
            ->where(function ($query) use ($postdata) {
                $query->where(function ($q) use ($postdata) {
                    $q->where('hora_inicio', '<', $postdata['horaFim'])
                        ->where('hora_fim', '>', $postdata['horaInicio']);
                })
                    ->orWhere(function ($q) use ($postdata) {
                        $q->where('hora_inicio', '>', $postdata['horaInicio'])
                            ->where('hora_inicio', '<', $postdata['horaFim']);
                    })
                    ->orWhere(function ($q) use ($postdata) {
                        $q->where('hora_fim', '>', $postdata['horaInicio'])
                            ->where('hora_fim', '<', $postdata['horaFim']);
                    });
            })
            ->exists();

        if ($agendamentosCriados) {
            return redirect()->back()->with('error', 'Já existe agendamentos entre o horário selecionado para esse funcionário!');
        }

        DB::beginTransaction();
        $agendamento = new Agendamentos();

        $agendamento->empresas_id = $empresa->id;
        $agendamento->users_id = 1;
        $agendamento->funcionarios_id = $postdata['funcionario_id'];
        $agendamento->servicos_id = $postdata['servico_id'];
        $agendamento->hora_inicio = $postdata['horaInicio'];
        $agendamento->hora_fim = $postdata['horaFim'];
        $agendamento->data = $postdata['data'];
        $agendamento->status = 0; //0-> agendado, 1->confirmado, 2->concluido, 3->cancelado, 4->faltante
        $agendamento->nome_cliente = $postdata['nome_cliente'];

        if ($agendamento->save()) {
            DB::commit();
            return redirect()->back()->with('success', 'Agendamento criado com sucesso!');
        } else {
            DB::rollback();
            return redirect()->back()->with('error', 'Erro ao criar o Agendamento. Por favor, tente novamente.');
        }
    }

    public function update(Request $request, $id)
    {
        $agendamento = Agendamentos::findOrFail($id);

        // $validator = Agendamentos::validate($request->all());

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $agendamento->update([
            // 'funcionarios_id' => $request->input('funcionario_id'),
            'servicos_id' => $request->input('servico_id'),
            'nome_cliente' => $request->input('nome_cliente'),
        ]);

        return redirect()->back()->with('success', 'Agendamento atualizada com sucesso!');
    }


    public function filtros(Request $request)
    {
        $userId = 1;

  
        $query = Agendamentos::query()->where('users_id', $userId);

        if ($request->filled('servicos_id')) {
            $query->where('servicos_id', $request->input('servicos_id'));
        }

        // Filtrar por data, se fornecido
        if ($request->filled('data')) {
            $query->whereDate('data', Carbon::parse($request->input('data'))->format('Y-m-d'));
        }

        // Filtrar por funcionário, se fornecido
        if ($request->filled('funcionarios_id')) {
            $query->where('funcionarios_id', $request->input('funcionarios_id'));
        }

        // Filtrar por status, se fornecido
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Executar a consulta e obter os resultados
        $agendamentos = $query->orderBy('data', 'desc')->get();

        // Formatar os agendamentos
        $agendamentosFormatados = [];
        foreach ($agendamentos as $agendamento) {
            $servico = Servicos::find($agendamento->servicos_id);
            $funcionario = Funcionarios::find($agendamento->funcionarios_id);
            $agendamentoFormatado = [
                'Data' => $agendamento->data->format('d/m/Y'),
                'hora_inicio' => $agendamento->hora_inicio->format('H:i'),
                'hora_fim' => $agendamento->hora_fim->format('H:i'),
                'Cliente' => $agendamento->nome_cliente,
                'Nome' => $servico ? $servico->nome_servico : 'Serviço não encontrado',
                'Funcionario' => $funcionario->nome,
                'Status' => $agendamento->status,
                'Valor' => $servico ? $servico->valor : 0,
            ];
            $agendamentosFormatados[] = $agendamentoFormatado;
        }

        return response()->json($agendamentosFormatados);
    }

    public function delete($id)
    {
        $agendamento = Agendamentos::findOrFail($id);

        if ($agendamento->delete()) {
            return redirect()->back()->with('success', 'Agendamento deletado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao deletar o agendamento. Por favor, tente novamente.');
        }
    }
}
