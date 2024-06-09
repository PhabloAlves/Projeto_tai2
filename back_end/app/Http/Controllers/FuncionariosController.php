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
        $id = 1;//teste, lembrar de mudar quando login voltar
        $empresa = Empresas::where('users_id', $id)->first();
        $funcionarios = Funcionarios::where('empresas_id', $empresa->id)->get();

        return view('site.funcionarios.index', compact('funcionarios'));
    }

    public function create(Request $request)
    {
        $funcionario = new Funcionarios;
        $funcionario->fill($request->all());
        $funcionario->save();
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

        $empresa = Empresas::where('users_id', 1)->first();

        $funcionario = new Funcionarios();

        $funcionario->empresas_id = $empresa->id;
        $funcionario->users_id = 1;
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
