<?php

namespace App\Http\Controllers;

use App\Models\Servicos;
use App\Models\CategoriasServicos;
use App\Models\Empresas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ServicosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user()->id; // Carrega o usuário logado
            $this->empresa = Empresas::where('users_id', $this->user)->first();

            view()->share('empresa', $this->empresa);
            view()->share('jsFile', 'servicos.js');
            return $next($request);
        });
    }

    public function index()
    {
        $userId = $this->user;
        $empresaId = $this->empresa->id;

        $selectServicos = Servicos::where('empresas_id', $empresaId)
            ->where('users_id', $userId)
            ->get();

        $selectCategorias = CategoriasServicos::where('empresas_id', $empresaId)
            ->where('users_id', $userId)
            ->get();

        $servicos = Servicos::join('categorias_servicos', 'categorias_servicos.id', 'servicos.categorias_servicos_id')
            ->where('servicos.empresas_id', $empresaId)
            ->where('servicos.users_id', $userId)
            ->get();

        return view('site.servicos.index', compact('servicos', 'selectServicos', 'selectCategorias'));
    }

    public function dados()
    {
        $userId = $this->user;
        $empresaId = $this->empresa->id;

        $servicos = Servicos::where('empresas_id', $empresaId)
            ->where('users_id', $userId)
            ->get();

        return response($servicos);
    }

    public function create($id = null)
    {
        $userId = $this->user;
        $empresaId = $this->empresa->id;

        if ($id != null) {
            $servico = Servicos::findOrFail($id);
        } else {
            $servico = new Servicos();
        }

        $categorias = CategoriasServicos::where('empresas_id', $empresaId)
            ->where('users_id', $userId)
            ->get();

        return view('site.servicos.form', compact('servico', 'categorias'));
    }

    public function store(Request $request)
    {
        $userId = $this->user;
        $empresaId = $this->empresa->id;

        $validator = Servicos::validate($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $servico = new Servicos();

        $servico->empresas_id = $empresaId;
        $servico->users_id = $userId;
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

        $validator = Servicos::validate($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

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
