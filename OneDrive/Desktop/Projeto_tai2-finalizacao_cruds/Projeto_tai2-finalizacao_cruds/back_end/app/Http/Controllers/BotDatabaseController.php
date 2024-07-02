<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; // Importar a facade Log

class BotDatabaseController implements ShouldQueue
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
            Log::info('Agendamentos recebidos: ', $agendamentos);

        } else {
            // Tratar erros
            Log::error('Falha ao buscar agendamentos: ' . $response->body());
        }
    }
}
