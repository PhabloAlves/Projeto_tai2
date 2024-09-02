<?php

namespace App\Http\Controllers;

use App\Models\Servicos;
use App\Models\CategoriasServicos;
use App\Models\Empresas;
use Illuminate\Http\Request;

class ServicosController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            view()->share('jsFile', 'servicos.js');
            return $next($request);
        });
    }

    public function index()
    {
        $id = 1; //teste, lembrar de mudar quando login voltar
        $empresa = Empresas::where('users_id', $id)->first();
        $servicos = Servicos::join('categorias_servicos', 'categorias_servicos.id', 'servicos.categorias_servicos_id')
            ->where('servicos.empresas_id', $empresa->id)->get();

        return view('site.servicos.index', compact('servicos'));
    }

    public function dados()
    {
        $id = 1; //teste, lembrar de mudar quando login voltar
        $empresa = Empresas::where('users_id', $id)->first();
        $servicos = Servicos::where('empresas_id', $empresa->id)->get();

        return response($servicos);
    }

    public function create($id = null)
    {
        if ($id != null) {
            $servico = Servicos::findOrFail($id);
        } else {
            $servico = new Servicos();
        }

        $idusuario = 1; //teste, lembrar de mudar quando login voltar
        $empresa = Empresas::where('users_id', $idusuario)->first();
        $categorias = CategoriasServicos::where('empresas_id', $empresa->id)->get();

        return view('site.servicos.form', compact('servico', 'categorias'));
    }

    public function store(Request $request)
    {
        // $validator = Servicos::validate($request->all());

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $empresa = Empresas::where('users_id', 1)->first();

        $servico = new Servicos();

        $servico->empresas_id = $empresa->id;
        $servico->users_id = 1;
        $servico->categorias_servicos_id = $request->input('categoria_id');
        $servico->nome_servico = $request->input('nome_servico');
        $servico->valor =  str_replace(',', '.', $request->input('valor'));

        if ($servico->save()) {
            return redirect()->back()->with('success', 'Serviço cadastrado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao cadastrar o Serviço. Por favor, tente novamente.');
        }
    }

    public function update(Request $request, $id)
    {
        $servico = Servicos::findOrFail($id);

        // $validator = Servicos::validate($request->all());

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $servico->update([
            'categorias_servicos_id' => $request->input('categoria_id'),
            'nome_servico' => $request->input('nome_servico'),
            'valor' => $request->input('valor'),
        ]);

        return redirect()->back()->with('success', 'Serviço atualizado com sucesso!');
    }

    public function delete($id)
    {
        $servico = Servicos::findOrFail($id);

        if ($servico->delete()) {
            return redirect()->back()->with('success', 'Serviço deletado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao deletar o serviço. Por favor, tente novamente.');
        }
    }
}
