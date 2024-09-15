@extends('layouts.app')

@section('title', 'Agendamento - Marca Aí')

@section('header', 'Agendamento')

@section('content')
<div class="container mt-5">
    <div class="rounded-4 bg-light p-4 mb-4">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row justify-content-end mb-3">
            <div class="col-auto">
                <a href="{{ route('agendamentos.create') }}" class="btn btn-primary" target="_blank">Novo</a>
            </div>
        </div>
        <div class="row">
            <div class="col bg-light">
                <table class="table">
                <thead>
    <tr>
        <th>Data 
            <input id="data-filter-input" type="date" class="form-control">
        </th>

        <th class="align-middle">Hora Início</th> <!-- Alinhamento vertical no meio -->
        
        <th class="align-middle">Cliente</th> <!-- Alinhamento vertical no meio -->
        
        <th>Serviço
            <select id="servico-filter-select" class="form-select">
                <option value="">Todos</option>
                <!-- Opções serão inseridas dinamicamente -->
            </select>
        </th>

        <th>Funcionário
            <select id="funcionario-filter-select" class="form-select">
                <option value="">Todos</option>
                <!-- Opções serão inseridas dinamicamente -->
            </select>
        </th>

        <th>Status
            <select id="status-filter-select" class="form-select">
                <option value="">Todos</option>
                <!-- Opções serão inseridas dinamicamente -->
            </select>
        </th>

        <th class="align-middle">Valor</th> <!-- Alinhamento vertical no meio -->
    </tr>
</thead>
                    <tbody id="agenda-table-body">
                        <!-- Dados serão inseridos aqui via JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    /*
    $(document).ready(function() {
        $.ajax({
            url: '/agendamentos_dados', // Rota correta para buscar os dados
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var tableBody = $('#agenda-table-body');
                tableBody.empty();

                data.forEach(function(agendamento) {
                    var statusText;
                    var statusClass;

                    if (agendamento.Status === 'Cancelado') {
                        statusText = 'Cancelado';
                        statusClass = 'cancel';
                    } else if (agendamento.Status === 'Concluído') {
                        statusText = 'Serviço Finalizado';
                        statusClass = 'done';
                    } else {
                        statusText = 'Confirmado';
                        statusClass = 'confirm';
                    }

                    var row = `<tr>
                        <td>${agendamento.Data}</td>
                        <td>${agendamento.hora_inicio}</td>
                        <td>${agendamento.Cliente}</td>
                        <td>${agendamento.Nome}</td>
                        <td>${agendamento.Funcionario}</td>
                        <td class="${statusClass}">${statusText}</td>
                        <td>R$ ${agendamento.Valor}</td>
                    </tr>`;

                    tableBody.append(row);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Erro ao buscar os dados: ' + textStatus);
            }
        });
    });
*/

$(document).ready(function() {
    var allData = []; // Armazena todos os agendamentos recebidos

    // Função para filtrar e renderizar a tabela com base nos filtros selecionados
    function filterAndRenderTable(selectedDate, selectedServico, selectedFuncionario, selectedStatus) {
        var filteredData = allData;

        // Filtrar por data
        if (selectedDate) {
            filteredData = filteredData.filter(function(agendamento) {
                // Transforma a data para o mesmo formato para comparação
                var agendamentoData = new Date(agendamento.Data).toISOString().split('T')[0];
                return agendamentoData === selectedDate;
            });
        }

        // Filtrar por serviço
        if (selectedServico) {
            filteredData = filteredData.filter(function(agendamento) {
                return agendamento.Nome === selectedServico;
            });
        }

        // Filtrar por funcionário
        if (selectedFuncionario) {
            filteredData = filteredData.filter(function(agendamento) {
                return agendamento.Funcionario === selectedFuncionario;
            });
        }

        // Filtrar por status
        if (selectedStatus) {
            filteredData = filteredData.filter(function(agendamento) {
                return agendamento.Status === selectedStatus;
            });
        }

        var tableBody = $('#agenda-table-body');
        tableBody.empty();

        filteredData.forEach(function(agendamento) {
            var statusText;
            var statusClass;

            if (agendamento.Status === 'Cancelado') {
                statusText = 'Cancelado';
                statusClass = 'cancel';
            } else if (agendamento.Status === 'Concluído') {
                statusText = 'Serviço Finalizado';
                statusClass = 'done';
            } else {
                statusText = 'Confirmado';
                statusClass = 'confirm';
            }

            var row = `<tr>
                <td>${agendamento.Data}</td>
                <td>${agendamento.hora_inicio}</td>
                <td>${agendamento.Cliente}</td>
                <td>${agendamento.Nome}</td>
                <td>${agendamento.Funcionario}</td>
                <td class="${statusClass}">${statusText}</td>
                <td>R$ ${agendamento.Valor}</td>
            </tr>`;

            tableBody.append(row);
        });
    }

    // Carregar dados via AJAX
    $.ajax({
        url: '/agendamentos_dados',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            allData = data;

            // Renderizar a tabela inicial com todos os dados
            filterAndRenderTable();

            // Obter todas as opções únicas para preencher os selects
            var uniqueServicos = [...new Set(data.map(item => item.Nome))];
            var uniqueFuncionarios = [...new Set(data.map(item => item.Funcionario))];
            var uniqueStatuses = ['Confirmado', 'Concluído', 'Cancelado'];

            // Preencher o select de serviços
            uniqueServicos.forEach(function(servico) {
                var option = `<option value="${servico}">${servico}</option>`;
                $('#servico-filter-select').append(option);
            });

            // Preencher o select de funcionários
            uniqueFuncionarios.forEach(function(funcionario) {
                var option = `<option value="${funcionario}">${funcionario}</option>`;
                $('#funcionario-filter-select').append(option);
            });

            // Preencher o select de status
            uniqueStatuses.forEach(function(status) {
                var option = `<option value="${status}">${status}</option>`;
                $('#status-filter-select').append(option);
            });

            // Eventos de mudança nos filtros
            $('#data-filter-input').on('change', function() {
                var selectedDate = $(this).val();
                filterAndRenderTable(selectedDate, $('#servico-filter-select').val(), $('#funcionario-filter-select').val(), $('#status-filter-select').val());
            });

            $('#servico-filter-select').on('change', function() {
                var selectedServico = $(this).val();
                filterAndRenderTable($('#data-filter-input').val(), selectedServico, $('#funcionario-filter-select').val(), $('#status-filter-select').val());
            });

            $('#funcionario-filter-select').on('change', function() {
                var selectedFuncionario = $(this).val();
                filterAndRenderTable($('#data-filter-input').val(), $('#servico-filter-select').val(), selectedFuncionario, $('#status-filter-select').val());
            });

            $('#status-filter-select').on('change', function() {
                var selectedStatus = $(this).val();
                filterAndRenderTable($('#data-filter-input').val(), $('#servico-filter-select').val(), $('#funcionario-filter-select').val(), selectedStatus);
            });

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Erro ao buscar os dados: ' + textStatus);
        }
    });
});

</script>

@endsection
