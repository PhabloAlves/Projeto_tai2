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
                            <th>Data</th>
                            <th>Hora Início</th>
                            <th>Cliente</th>
                            <th>Serviço</th>
                            <th>Funcionário</th>
                            <th>Status</th>
                            <th>Valor</th>
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
</script>

@endsection
