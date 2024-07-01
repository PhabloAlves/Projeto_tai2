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
                            <th>Funcionário</th>
                            <th>Serviço</th>
                            <th>Data</th>
                            <th>Hora Início</th>
                            <th>Hora Fim</th>
                            <th>Cliente</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agendamentos as $agendamento)
                        <tr>
                            <td>{{ $agendamento->nome }} {{ $agendamento->sobrenome }}</td>
                            <td>{{ $agendamento->servico }}</td>
                            <td>{{ $agendamento->dataAg }}</td>
                            <td>{{ $agendamento->horaInicio }}</td>
                            <td>{{ $agendamento->horaFim }}</td>
                            <td>{{ $agendamento->nome_cliente }}</td>
                            <td>{{ $agendamento->status }}</td>
                            <td>
                                <a href="{{ route('agendamentos.create', $agendamento->id) }}" target="_blank" class="text-primary"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('agendamentos.delete', $agendamento->id) }}" method="POST" style="display: inline;">
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