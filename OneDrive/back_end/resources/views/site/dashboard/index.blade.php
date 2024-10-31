@extends('layouts.app')

@section('title', 'Agenda do Dia - Marca Aí')

@section('header', 'Agenda do Dia')

@section('content')
<div class="container mt-5">
    <div class="rounded-4 bg-light p-4 mb-4">
        <div class="row">
            <div class="col bg-light">
                <table class="table" id="tabelaAgendamentos">
                    <thead>
                        <tr>
                            <th>Data</th>

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