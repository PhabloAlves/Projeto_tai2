<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\_Protocol;
use Util;
use Illuminate\Support\Facades\Auth;

class EmpresasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user()->id; // Carrega o usuário logado

            view()->share('jsFile', 'empresas.js');
            return $next($request);
        });
    }
    
    public function index()
    {
        $userId = $this->user;

        $empresa = Empresas::where('users_id', $userId)->first() ?? new Empresas();
        return view('site.empresas.index', compact('empresa'));
    }

    public function store(Request $request)
    {
        $userId = $this->user;

        $validator = Empresas::validate($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $empresa = new Empresas();
        $empresa->users_id = $userId;
        $empresa->identificacao = $request->input('identificacao');
        $empresa->razao_social = $request->input('razaoSocial');
        $empresa->tipo_inscricao = $request->input('tipoInscricao');
        $empresa->inscricao = $request->input('inscricao');
        $empresa->email = $request->input('email');
        $empresa->telefone = $request->input('telefone');
        $empresa->endereco = $request->input('endereco');
        $empresa->bairro = $request->input('bairro');
        $empresa->cep = Util::remove_mascara_cep($request->input('cep'));
        $empresa->cidade = $request->input('cidade');
        $empresa->uf = $request->input('uf');

        if ($empresa->save()) {
            return redirect()->back()->with('success', 'Empresa cadastrada com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao cadastrar empresa!');
        }
    }

    public function update(Request $request, $id)
    {
        $empresa = Empresas::findOrFail($id);

        $validator = Empresas::validate($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $empresa->update([
            'identificacao' => $request->input('identificacao'),
            'razao_social' => $request->input('razaoSocial'),
            'tipo_inscricao' => $request->input('tipoInscricao'),
            'inscricao' => $request->input('inscricao'),
            'email' => $request->input('email'),
            'telefone' => $request->input('telefone'),
            'endereco' => $request->input('endereco'),
            'bairro' => $request->input('bairro'),
            'cep' => Util::remove_mascara_cep($request->input('cep')),
            'cidade' => $request->input('cidade'),
            'uf' => $request->input('uf'),
        ]);

        return redirect()->back()->with('success', 'Empresa atualizada com sucesso!');
    }
}
