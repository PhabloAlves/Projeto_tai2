<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\_Protocol;

class EmpresasController extends Controller
{
    public function index()
    {
        $empresa = Empresas::where('idusuario', 1)->first() ?? new Empresas();
        return view('site.empresas.index', compact('empresa'));
    }

    public function store(Request $request)
    {
        // $validator = Empresas::validate($request->all());

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $empresa = new Empresas();
        $empresa->idusuario = 1;
        $empresa->identificacao = $request->input('identificacao');
        $empresa->razao_social = $request->input('razaoSocial');
        $empresa->tipo_inscricao = $request->input('tipoInscricao');
        $empresa->inscricao = $request->input('inscricao');
        $empresa->email = $request->input('email');
        $empresa->telefone = $request->input('telefone');
        $empresa->endereco = $request->input('endereco');
        $empresa->bairro = $request->input('bairro');
        $empresa->cep = $request->input('cep');
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

        $empresa->update([
            'identificacao' => $request->input('identificacao'),
            'razao_social' => $request->input('razaoSocial'),
            'tipo_inscricao' => $request->input('tipoInscricao'),
            'inscricao' => $request->input('inscricao'),
            'email' => $request->input('email'),
            'telefone' => $request->input('telefone'),
            'endereco' => $request->input('endereco'),
            'bairro' => $request->input('bairro'),
            'cep' => $request->input('cep'),
            'cidade' => $request->input('cidade'),
            'uf' => $request->input('uf'),
        ]);

        return redirect()->back()->with('success', 'Empresa atualizada com sucesso!');
    }
}
