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
                <a href="{{ route('agendamentos.exportar') }}" class="btn btn-primary" target="_blank">Gerar relatório <span class="bi bi-box-arrow-in-down"></a>
            </div>
        </div>
        <div class="row">
            <div class="col bg-light">
                <table class="table" id="tabelaAgendamentos">
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

@endsection