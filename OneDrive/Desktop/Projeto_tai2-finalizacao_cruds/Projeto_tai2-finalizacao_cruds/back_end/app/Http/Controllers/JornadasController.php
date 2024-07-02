<?php

namespace App\Http\Controllers;

use App\Models\Jornadas;
use App\Models\Empresas;
use App\Models\Funcionarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JornadasController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            view()->share('jsFile', 'jornadas.js');
            return $next($request);
        });
    }

    public function index()
    {
        $id = 1; //teste, lembrar de mudar quando login voltar
        $empresa = Empresas::where('users_id', $id)->first();
        $jornadas = Jornadas::join('funcionarios', 'funcionarios.id', 'jornadas.funcionarios_id')
            ->where('jornadas.empresas_id', $empresa->id)
            ->select(
                'jornadas.id',
                'jornadas.diaMes',
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

        foreach ($jornadas as &$jornada) {
            if ($jornada->diaMes != null) {
                $jornada->dia = $jornada->diaMes->format('d/m/Y');
            } 
            $jornada->operacao = $operacao[$jornada->operacao];
            // $jornada->horaIni = $jornada->horaInicio->format('H:i');
            // $jornada->horaF = $jornada->horaFim->format('H:i');
        }

        return view('site.jornadas.index', compact('jornadas'));
    }

    public function create($id = null)
    {
        if ($id != null) {
            $jornada = Jornadas::findOrFail($id);
            $dataMes = $jornada->diaMes ? $jornada->diaMes->format('Y-m-d') : null;
            $jornada = $jornada->toArray();
            $jornada['diaMes'] = $dataMes;
        } else {
            $jornada = new Jornadas();
        }

        $idusuario = 1; //teste, lembrar de mudar quando login voltar
        $empresa = Empresas::where('users_id', $idusuario)->first();
        $funcionarios = Funcionarios::where('empresas_id', $empresa->id)->get();

        return view('site.jornadas.form', compact('jornada', 'funcionarios'));
    }

    public function store(Request $request)
    {
        // $validator = Jornadas::validate($request->all());

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $empresa = Empresas::where('users_id', 1)->first();
        $postdata = $request->input();

        DB::beginTransaction();
        $jornada = new Jornadas();

        if (array_key_exists('diaSemana', $postdata)) {
            foreach ($postdata['diaSemana'] as $diaSemana) {
                $jornada = new Jornadas();
                $jornada->empresas_id = $empresa->id;
                $jornada->users_id = 1;
                $jornada->funcionarios_id = $postdata['funcionario_id'];
                $jornada->horaInicio = $postdata['horaInicio'];
                $jornada->horaFim = $postdata['horaFim'];
                $jornada->operacao = $postdata['operacao'];
                $jornada->diaMes = null;

                $jornada->save();
            }
        } else if (array_key_exists('diaMes', $postdata)) {
            $jornada = new Jornadas();
            $jornada->empresas_id = $empresa->id;
            $jornada->users_id = 1;
            $jornada->funcionarios_id = $postdata['funcionario_id'];
            $jornada->horaInicio = $postdata['horaInicio'];
            $jornada->horaFim = $postdata['horaFim'];
            $jornada->operacao = $postdata['operacao'];
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

        // $validator = Jornadas::validate($request->all());

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

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
