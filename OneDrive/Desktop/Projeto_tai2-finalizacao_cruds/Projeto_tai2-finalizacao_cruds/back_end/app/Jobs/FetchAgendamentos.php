<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\Agendamentos;
use App\Models\Funcionarios;
use App\Models\Servicos;
use Carbon\Carbon;

class FetchAgendamentos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // URL da endpoint
        $url = 'https://marcaai-v2-fpdw-default-rtdb.firebaseio.com/agendamentos.json';

        // Fazer a requisição GET
        $response = Http::get($url);

        // Verificar se a requisição foi bem-sucedida
        if ($response->successful()) {
            // Obter o JSON da resposta
            $agendamentos = $response->json();

            // Logar o JSON recebido
            \Log::info('Agendamentos recebidos: ', $agendamentos);

            // Iterar sobre cada agendamento
            foreach ($agendamentos as $id => $agendamento) {
                // Logar o ID do agendamento
                \Log::info('Processando agendamento com ID: ' . $id);

                // Verificar se o funcionário existe
                $funcionario = Funcionarios::where('nome', $agendamento['funcionario'])->first();
                if (!$funcionario) {
                    \Log::warning('Funcionário não encontrado: ' . $agendamento['funcionario']);
                    continue; // Pular para o próximo registro
                }
                
                // Verificar se o serviço existe
                $servico = Servicos::where('nome_servico', $agendamento['servico'])->first();
                if (!$servico) {
                    \Log::warning('Serviço não encontrado: ' . $agendamento['servico']);
                    continue; // Pular para o próximo registro
                }
                
                // Calcular a hora_fim
                $horaInicio = Carbon::createFromFormat('H:i', $agendamento['hora_inicio']);
                $horaFim = $horaInicio->copy()->addMinutes($servico->duracao);
                
                // Verificar se o agendamento já existe no banco de dados
                $existingAgendamento = Agendamentos::find($id);
                
                if ($existingAgendamento) {
                    // Atualizar o agendamento existente
                    $existingAgendamento->update([
                        'data' => $this->formatarData($agendamento['data']),
                        'hora_inicio' => $agendamento['hora_inicio'],
                        'hora_fim' => $horaFim->format('H:i:s.u'),
                        'funcionarios_id' => $funcionario->id,
                        'servicos_id' => $servico->id,
                        'status' => 1,
                        'users_id' => $funcionario->users_id,
                        'nome_cliente' => $agendamento['nome_cliente'],
                        'servico' => $agendamento['servico'],
                        'telefone' => $agendamento['telefone'],
                        'empresas_id' => $agendamento['empresas_id']
                    ]);
                } else {
                    // Criar um novo agendamento
                    Agendamentos::create([
                        'id' => $id,
                        'data' => $this->formatarData($agendamento['data']),
                        'hora_inicio' => $agendamento['hora_inicio'],
                        'hora_fim' => $horaFim->format('H:i:s.u'),
                        'funcionarios_id' => $funcionario->id,
                        'status' => 1,
                        'servicos_id' => $servico->id,
                        'users_id' => $funcionario->users_id,
                        'nome_cliente' => $agendamento['nome_cliente'],
                        'servico' => $agendamento['servico'],
                        'telefone' => $agendamento['telefone'],
                        'empresas_id' => $agendamento['empresas_id']
                    ]);
                }
            }

            // Deletar os agendamentos após o processamento bem-sucedido
            $response = Http::delete($url);
        } else {
            // Tratar erros
            \Log::error('Falha ao buscar agendamentos: ' . $response->body());
        }
    }

    /**
     * Formatar a data para o formato adequado.
     *
     * @param string $data
     * @return string
     */
    private function formatarData($data)
    {
        // Adicione o ano atual para criar um objeto Carbon corretamente
        $dataFormatada = Carbon::createFromFormat('d/m', $data)->setYear(now()->year);
        return $dataFormatada->format('Y-m-d');
    }
}
