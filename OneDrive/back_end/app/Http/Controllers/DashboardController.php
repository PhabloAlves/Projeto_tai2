<?php

namespace App\Http\Controllers;

use App\Models\Agendamentos;
use App\Models\Empresas;
use App\Models\Funcionarios;
use App\Models\Jornadas;
use App\Models\Servicos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

use App\Exports\PlanilhaExport;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user()->id; // Carrega o usuário logado
            $this->empresa = Empresas::where('users_id', $this->user)->first();

            view()->share('empresa', $this->empresa);
            view()->share('jsFile', 'dashboard.js');
            return $next($request);
        });
    }

    public function index()
    {
        return view('site.dashboard.index');
    }

    public function dados()
    {
        $userId = $this->user;
        $empresaId = $this->empresa->id;

        $agendamentos = Agendamentos::where('empresas_id', $empresaId)
            ->where('users_id', $userId)
            ->where('data', date('Y-m-d'))
            ->orderBy('data', 'asc')
            ->get();

        $agendamentosFormatados = [];

        foreach ($agendamentos as $agendamento) {
            $servico = Servicos::find($agendamento->servicos_id);
            $funcionario = Funcionarios::find($agendamento->funcionarios_id);
            $agendamentoFormatado = [
                'id' => $agendamento->id,
                'Data' => $agendamento->data->format('d/m/Y'),
                'hora_inicio' => $agendamento->hora_inicio->format('H:i'),
                'hora_fim' => $agendamento->hora_fim->format('H:i'),
                'Cliente' => $agendamento->nome_cliente,
                'Nome' => $servico->nome_servico,
                'Funcionario' => $funcionario->nome,
                'Status' => $agendamento->status,
                'Valor' => $servico ? $servico->valor : 0,
            ];

            $agendamentosFormatados[] = $agendamentoFormatado;
        }

        return response()->json($agendamentosFormatados);
    }

    public function updateStatus(Request $request, $id)
    {
        $agendamento = Agendamentos::findOrFail($id);
        $agendamento->status = $request->input('Status');
        $agendamento->save();

        return response()->json($agendamento, 200);
    }

    public function servico()
    {
        return $this->belongsTo(Servicos::class, 'servicos_id');
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionarios::class, 'funcionarios_id');
    }
}
