<?php

namespace App\Http\Controllers;

use App\Models\Jornadas;
use App\Models\Empresas;
use App\Models\Funcionarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JornadasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user()->id; // Carrega o usuário logado
            $this->empresa = Empresas::where('users_id', $this->user)->first();

            view()->share('empresa', $this->empresa);
            view()->share('jsFile', 'jornadas.js');
            return $next($request);
        });
    }
    
    public function filtros(Request $request)
    {
        $userId = $this->user;
        $empresaId = $this->empresa->id;

        // Inicia a query base
        $query = Jornadas::join('funcionarios', 'funcionarios.id', 'jornadas.funcionarios_id')
            ->where('empresas_id', $empresaId)
            ->where('users_id', $userId)
            ->select(
                'jornadas.id',
                'jornadas.diaMes',
                'jornadas.horaInicio',
                'jornadas.horaFim',
                'jornadas.operacao',
                'funcionarios.nome',
                'funcionarios.sobrenome'
            );

        // Aplica os filtros se presentes na requisição
        if ($request->has('funcionarios_id')) {
            $query->where('jornadas.funcionarios_id', $request->input('funcionarios_id'));
        }

        if ($request->has('diaMes')) {
            $query->whereDate('jornadas.diaMes', $request->input('diaMes'));
        }

        if ($request->has('operacao')) {
            $query->where('jornadas.operacao', $request->input('operacao'));
        }

        // Ordena os resultados pela data (diaMes) em ordem decrescente
        $query->orderBy('jornadas.diaMes', 'desc');

        // Executa a query e obtém os resultados
        $jornadas = $query->get();

        // Mapeia os valores de 'operacao'
        $operacao = [
            'Adição',
            'Subtração',
        ];

        // Formata os resultados
        foreach ($jornadas as &$jornada) {
            if ($jornada->diaMes != null) {
                $jornada->dia = $jornada->diaMes->format('d/m/Y');
            }
            $jornada->operacao = $operacao[$jornada->operacao];
        }

        // Retorna os resultados como JSON
        return response()->json($jornadas);
    }

    public function dados($nome)
    {
        $userId = $this->user;
        $empresaId = $this->empresa->id;

        $funcionario = Funcionarios::where('nome', $nome)->first();
        $jornadas = Jornadas::where('empresas_id', $empresaId)
            ->where('users_id', $userId)
            ->where('funcionarios_id', $funcionario->id)
            ->where('operacao', 0)
            ->get();

        return response()->json($jornadas);
    }

    public function index()
    {
        $userId = $this->user;
        $empresaId = $this->empresa->id;

        $selectFuncionario = Funcionarios::where('empresas_id', $empresaId)->get();

        $jornadas = Jornadas::join('funcionarios', 'funcionarios.id', 'jornadas.funcionarios_id')
            ->where('jornadas.empresas_id', $empresaId)
            ->where('jornadas.users_id', $userId)
            ->select(
                'jornadas.id',
                'jornadas.diaMes',
                'jornadas.diaSemana',
                'jornadas.horaInicio',
                'jornadas.horaFim',
                'jornadas.operacao',
                'funcionarios.nome',
                'funcionarios.sobrenome'
            )
            ->get();

        $operacao = [
            'Adição',
            'Subtração',
        ];

        $diasSemana = [
            0 => 'Domingo',
            1 => 'Segunda-Feira',
            2 => 'Terça-Feira',
            3 => 'Quarta-Feira',
            4 => 'Quinta-Feira',
            5 => 'Sexta-Feira',
            6 => 'Sábado',
        ];

        foreach ($jornadas as &$jornada) {
            if ($jornada->diaMes != null) {
                $jornada->dia = $jornada->diaMes->format('d/m/Y');
            } else {
                $jornada->dia = $diasSemana[$jornada->diaSemana];
            }
            $jornada->operacao = $operacao[$jornada->operacao];
        }

        return view('site.jornadas.index', compact('jornadas', 'selectFuncionario'));
    }

    public function create($id = null)
    {
        $userId = $this->user;
        $empresaId = $this->empresa->id;

        if ($id != null) {
            $jornada = Jornadas::findOrFail($id);
            $dataMes = $jornada->diaMes ? $jornada->diaMes->format('Y-m-d') : null;
            $jornada = $jornada->toArray();
            $jornada['diaMes'] = $dataMes;
        } else {
            $jornada = new Jornadas();
        }

        $funcionarios = Funcionarios::where('empresas_id', $empresaId)
            ->where('users_id', $userId)
            ->get();

        return view('site.jornadas.form', compact('jornada', 'funcionarios'));
    }

    public function store(Request $request)
    {
        $userId = $this->user;
        $empresaId = $this->empresa->id;

        $validator = Jornadas::validate($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $postdata = $request->input();

        DB::beginTransaction();
        $jornada = new Jornadas();

        if (array_key_exists('diaSemana', $postdata)) {
            foreach ($postdata['diaSemana'] as $diaSemana) {
                $jornada = new Jornadas();
                $jornada->empresas_id = $empresaId;
                $jornada->users_id = $userId;
                $jornada->funcionarios_id = $postdata['funcionario_id'];
                $jornada->horaInicio = $postdata['horaInicio'];
                $jornada->horaFim = $postdata['horaFim'];
                $jornada->operacao = $postdata['operacao'];
                $jornada->diaSemana = $diaSemana;
                $jornada->diaMes = null;

                $jornada->save();
            }
        } else if (array_key_exists('diaMes', $postdata)) {
            $jornada = new Jornadas();
            $jornada->empresas_id = $empresaId;
            $jornada->users_id = $userId;
            $jornada->funcionarios_id = $postdata['funcionario_id'];
            $jornada->horaInicio = $postdata['horaInicio'];
            $jornada->horaFim = $postdata['horaFim'];
            $jornada->operacao = $postdata['operacao'];
            $jornada->diaSemana = null;
            $jornada->diaMes = $postdata['diaMes'];

            $jornada->save();
        }

        if ($jornada->wasRecentlyCreated) {
            DB::commit();
            return redirect()->back()->with('success', 'Jornadas cadastradas com sucesso!');
        } else {
            DB::rollback();
            return redirect()->back()->with('error', 'Erro ao cadastrar as Jornadas. Por favor, tente novamente.');
        }
    }

    public function update(Request $request, $id)
    {
        $jornada = Jornadas::findOrFail($id);

        $validator = Jornadas::validate($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $jornada->update([
            'funcionarios_id' => $request->input('funcionario_id'),
            'horaInicio' => $request->input('horaInicio'),
            'horaFim' => $request->input('horaFim'),
            'operacao' => $request->input('operacao'),
        ]);

        return redirect()->back()->with('success', 'Jornada atualizada com sucesso!');
    }

    public function delete($id)
    {
        $jornada = Jornadas::findOrFail($id);

        if ($jornada->delete()) {
            return redirect()->back()->with('success', 'Jornada deletada com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao deletar a jornada. Por favor, tente novamente.');
        }
    }
}
