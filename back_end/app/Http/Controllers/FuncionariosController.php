<?php

namespace App\Http\Controllers;

use App\Models\Funcionarios;
use App\Models\Empresas;
use Illuminate\Http\Request;

class FuncionariosController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            view()->share('jsFile', 'funcionarios.js');
            return $next($request);
        });
    }

    public function index()
    {
        $empresa = Empresas::where('idusuario', 1)->first();
        $funcionarios = Funcionarios::where('idempresa', $empresa->id)->get();

        return view('site.funcionarios.index', compact('funcionarios'));
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
        // $validator = Funcionarios::validate($request->all());

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $empresa = Empresas::where('idusuario', 1)->first();

        $funcionario = new Funcionarios();

        $funcionario->idempresa = $empresa->id;
        $funcionario->idusuario = 1;
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
        $funcionario = Funcionarios::findOrFail($id);

        // $validator = Funcionarios::validate($request->all());

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

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

        if ($funcionario->delete()) {
            return redirect()->back()->with('success', 'Funcionário deletado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao deletar o funcionário. Por favor, tente novamente.');
        }
    }
}
