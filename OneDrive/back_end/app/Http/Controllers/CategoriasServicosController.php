<?php

namespace App\Http\Controllers;

use App\Models\CategoriasServicos;
use App\Models\Empresas;
use Illuminate\Http\Request;

class CategoriasServicosController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            view()->share('jsFile', 'categorias.js');
            return $next($request);
        });
    }

    public function index()
    {
        $id = 1; //teste, lembrar de mudar quando login voltar
        $empresa = Empresas::where('users_id', $id)->first();
        $categorias = CategoriasServicos::where('empresas_id', $empresa->id)->get();

        return view('site.categoriasservicos.index', compact('categorias'));
    }

    public function create($id = null)
    {
        if ($id != null) {
            $categoria = CategoriasServicos::findOrFail($id);
        } else {
            $categoria = new CategoriasServicos();
        }

        return view('site.categoriasservicos.form', compact('categoria'));
    }

    public function store(Request $request)
    {
        $validator = CategoriasServicos::validate($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $empresa = Empresas::where('users_id', 1)->first();

        $categoria = new CategoriasServicos();

        $categoria->empresas_id = $empresa->id;
        $categoria->users_id = 1;
        $categoria->nome_categoria = $request->input('nome_categoria');

        if ($categoria->save()) {
            return redirect()->back()->with('success', 'Categoria de Serviço cadastrada com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao cadastrar a Categoria de Serviço. Por favor, tente novamente.');
        }
    }

    public function update(Request $request, $id)
    {
        $categoria = CategoriasServicos::findOrFail($id);

        $validator = CategoriasServicos::validate($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $categoria->update([
            'nome_categoria' => $request->input('nome_categoria'),
        ]);

        return redirect()->back()->with('success', 'Categoria de Serviço atualizada com sucesso!');
    }

    public function delete($id)
    {
        $categoria = CategoriasServicos::findOrFail($id);

        if ($categoria->delete()) {
            return redirect()->back()->with('success', 'Categoria de Serviço deletada com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao deletar a Categoria de Serviço. Por favor, tente novamente.');
        }
    }
}
