<?php

namespace App\Http\Controllers;

use App\Models\Agendamentos;
use App\Models\Funcionarios;
use App\Models\Empresas;
use App\Models\Jornadas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FuncionariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user()->id; // Carrega o usuário logado
            $this->empresa = Empresas::where('users_id', $this->user)->first();

            view()->share('empresa', $this->empresa);
            view()->share('jsFile', 'funcionarios.js');
            return $next($request);
        });
    }

    public function index()
    {
        $userId = $this->user;
        $empresaId = $this->empresa->id;

        $funcionarios = Funcionarios::where('empresas_id', $empresaId)
            ->where('users_id', $userId)
            ->get();

        return view('site.funcionarios.index', compact('funcionarios'));
    }

    public function dados()
    {
        $userId = $this->user;
        $empresaId = $this->empresa->id;

        $funcionarios = Funcionarios::where('empresas_id', $empresaId)
            ->where('users_id', $userId)
            ->get();

        return response($funcionarios);
    }
    
    public function filtros(Request $request)
    {
        $userId = $this->user;
        $empresaId = $this->empresa->id;

        $nomeFiltro = $request->input('nome');

        $funcionarios = Funcionarios::where('empresas_id', $empresaId)
            ->where('users_id', $userId)
            ->where('nome', 'like', '%' . $nomeFiltro . '%')
            ->get();

        return response()->json($funcionarios);
    }

    public function create($id = null)
    {
        if ($id != null) {
            $funcionario = Funcionarios::findOrFail($id);

            $dataNascimento = $funcionario->data_nascimento ? $funcionario->data_nascimento->format('Y-m-d') : null;
            $funcionario = $funcionario->toArray();
            $funcionario['data_nascimento'] = $dataNascimento;
        } else {
            $funcionario = new Funcionarios();
        }

        return view('site.funcionarios.form', compact('funcionario'));
    }

    public function store(Request $request)
    {
        $userId = $this->user;
        $empresaId = $this->empresa->id;

        $validator = Funcionarios::validate($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $funcionario = new Funcionarios();

        $funcionario->empresas_id = $empresaId;
        $funcionario->users_id = $userId;
        $funcionario->nome = $request->input('nome');
        $funcionario->sobrenome = $request->input('sobrenome');
        $funcionario->data_nascimento = $request->input('dataNascimento');
        $funcionario->tipo_inscricao = $request->input('tipoInscricao');
        $funcionario->inscricao = $request->input('inscricao');
        $funcionario->telefone = $request->input('telefone');

        if ($funcionario->save()) {
            return redirect()->back()->with('success', 'Funcionário cadastrado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao cadastrar o funcionário. Por favor, tente novamente.');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Funcionarios::validate($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $funcionario = Funcionarios::findOrFail($id);

        $validator = Funcionarios::validate($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $funcionario->update([
            'nome' => $request->input('nome'),
            'sobrenome' => $request->input('sobrenome'),
            'data_nascimento' => $request->input('dataNascimento'),
            'tipo_inscricao' => $request->input('tipoInscricao'),
            'inscricao' => $request->input('inscricao'),
            'telefone' => $request->input('telefone'),
        ]);

        return redirect()->back()->with('success', 'Funcionário atualizado com sucesso!');
    }

    public function delete($id)
    {
        $funcionario = Funcionarios::findOrFail($id);
        $jornadas = Jornadas::where('funcionarios_id', $id)->exists();
        $agendamentos = Agendamentos::where('funcionarios_id', $id)->exists();

        if ($jornadas) {
            return redirect()->back()->with('error', 'Erro, funcionário vinculado a jornada(s)!');
        }

        if ($agendamentos) {
            return redirect()->back()->with('error', 'Erro, funcionário vinculado a agendamento(s)!');
        }

        if ($funcionario->delete()) {
            return redirect()->back()->with('success', 'Funcionário deletado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao deletar o funcionário. Por favor, tente novamente.');
        }
    }
}
