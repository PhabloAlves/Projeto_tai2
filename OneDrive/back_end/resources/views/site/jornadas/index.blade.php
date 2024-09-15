@extends('layouts.app')

@section('title', 'Jornadas - Marca Aí')

@section('header', 'Cadastro | Jornadas')

@section('content')
<div class="container mt-5">
    <div class="rounded-4 bg-light p-4 mb-4">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if ($errors->any() || session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row justify-content-end mb-3">
            <div class="col-auto">
                <a href="{{ route('jornadas.create') }}" class="btn btn-primary" target="_blank">Novo</a>
            </div>
        </div>
        <div class="row">
            <div class="col bg-light">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Funcionário
                                <select id="funcionario-filter-select" class="form-select">
                                    <option value="">Todos</option>
                                    <!-- Opções serão inseridas dinamicamente -->
                                </select>
                            </th>

                            <th>Dia
                                <input id="data-filter-input" type="date" class="form-control">
                            </th>

                            <th>Hora Início</th>

                            <th>Hora Fim</th>

                            <th>Operação
                                <select id="operacao-filter-select" class="form-select">
                                    <option value="">Todos</option>
                                    <!-- Opções serão inseridas dinamicamente -->
                                </select>
                            </th>
                            
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="jornada-table-body">
                        @foreach($jornadas as $jornada)
                        <tr>
                            <td>{{ $jornada->nome }} {{ $jornada->sobrenome }}</td>
                            <td>{{ $jornada->dia }}</td>
                            <td>{{ $jornada->horaInicio }}</td>
                            <td>{{ $jornada->horaFim }}</td>
                            <td>{{ $jornada->operacao }}</td>
                            <td>
                                <a href="{{ route('jornadas.create', $jornada->id) }}" target="_blank" class="text-primary"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('jornadas.delete', $jornada->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border: none; background-color: transparent;" class="text-primary"><i style="color: red;" class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
   $(document).ready(function() {
    var allData = []; // Armazena todos os dados das jornadas

    // Função para filtrar e renderizar a tabela com base nos filtros selecionados
    function filterAndRenderTable(selectedFuncionario, selectedDate, selectedOperacao) {
        var filteredData = allData;

        // Filtrar por funcionário
        if (selectedFuncionario) {
            filteredData = filteredData.filter(function(jornada) {
                return jornada.nome === selectedFuncionario;
            });
        }

        // Filtrar por dia (ajustando para o formato Y-m-d)
        if (selectedDate) {
            filteredData = filteredData.filter(function(jornada) {
                // Converte a data do agendamento para o formato Y-m-d
                var jornadaDate = new Date(jornada.dia).toISOString().split('T')[0];
                return jornadaDate === selectedDate;
            });
        }

        // Filtrar por operação
        if (selectedOperacao) {
            filteredData = filteredData.filter(function(jornada) {
                return jornada.operacao === selectedOperacao;
            });
        }

        var tableBody = $('#jornada-table-body');
        tableBody.empty();

        filteredData.forEach(function(jornada) {
            var row = `<tr>
                <td>${jornada.nome} ${jornada.sobrenome}</td>
                <td>${jornada.dia}</td>
                <td>${jornada.horaInicio}</td>
                <td>${jornada.horaFim}</td>
                <td>${jornada.operacao}</td>
                <td>
                    <a href="/jornadas/create/${jornada.id}" target="_blank" class="text-primary"><i class="fas fa-edit"></i></a>
                    <form action="/jornadas/delete/${jornada.id}" method="POST" style="display: inline;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" style="border: none; background-color: transparent;" class="text-primary"><i style="color: red;" class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>`;

            tableBody.append(row);
        });
    }

    // Carregar dados via AJAX
    $.ajax({
        url: '/jornadas_dados',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            allData = data;

            // Renderizar a tabela inicial com todos os dados
            filterAndRenderTable('', '', '');

            // Obter todas as opções únicas para preencher os selects
            var uniqueFuncionarios = [...new Set(data.map(item => item.nome))];
            var uniqueOperacoes = [...new Set(data.map(item => item.operacao))];

            // Preencher o select de funcionários
            uniqueFuncionarios.forEach(function(funcionario) {
                var option = `<option value="${funcionario}">${funcionario}</option>`;
                $('#funcionario-filter-select').append(option);
            });

            // Preencher o select de operações
            uniqueOperacoes.forEach(function(operacao) {
                var option = `<option value="${operacao}">${operacao}</option>`;
                $('#operacao-filter-select').append(option);
            });

            // Eventos de mudança nos filtros
            $('#funcionario-filter-select').on('change', function() {
                var selectedFuncionario = $(this).val();
                filterAndRenderTable(selectedFuncionario, $('#data-filter-input').val(), $('#operacao-filter-select').val());
            });

            $('#data-filter-input').on('change', function() {
                var selectedDate = $(this).val();
                filterAndRenderTable($('#funcionario-filter-select').val(), selectedDate, $('#operacao-filter-select').val());
            });

            $('#operacao-filter-select').on('change', function() {
                var selectedOperacao = $(this).val();
                filterAndRenderTable($('#funcionario-filter-select').val(), $('#data-filter-input').val(), selectedOperacao);
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Erro ao buscar os dados: ' + textStatus);
        }
    });
});

</script>

@endsection
