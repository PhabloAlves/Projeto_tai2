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
                <table class="table" id="tabelaJornadas">
                    <thead>
                        <tr>
                            <th>Funcionário
                                <select id="selectFuncionario" class="form-select">
                                    <option value="">Todos</option>
                                    @foreach($selectFuncionario as $funcionario)
                                    <option value="{{ $funcionario['id'] }}">
                                        {{ $funcionario['nome'] . ' ' . $funcionario['sobrenome'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </th>

                            <th>Dia
                                <input id="filtroData" type="date" class="form-control">
                            </th>

                            <th>Hora Início</th>

                            <th>Hora Fim</th>

                            <th>Operação
                                <select id="selectOperacao" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="0">Adição</option>
                                    <option value="1">Subtração</option>
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
@endsection