@extends('layouts.app')

@section('title', 'Agendamentos - Marca Aí')

@section('header', 'Cadastro | Agendamentos')

@section('content')
<div class="container-fluid mt-5">
        <div class="row justify-content-center">
                <div class="col-md-12">
                        <div class="rounded-4 bg-white p-4 mb-4">
                                <form id="agendamentoForm" action="{{ $agendamento['id'] ? route('agendamentos.update', $agendamento['id']) : route('agendamentos.store') }}" method="POST">
                                        @csrf
                                        @if(isset($agendamento['id']))
                                        @method('PUT')
                                        @endif
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
                                        <div class="row mb-3">
                                                <div class="col-md-8">
                                                        <label for="funcionario_id" class="form-label">Funcionário:</label>
                                                        <select name="funcionario_id" class="form-select" id="funcionario_id">
                                                                <option value="">Selecione...</option>
                                                                @foreach($funcionarios as $funcionario)
                                                                <option value="{{ $funcionario['id'] }}" {{ (isset($agendamento) && $agendamento['funcionarios_id'] == $funcionario['id']) ? 'selected' : '' }}>
                                                                        {{ $funcionario['nome'] . ' ' . $funcionario['sobrenome'] }}
                                                                </option>
                                                                @endforeach
                                                        </select>
                                                </div>
                                                <div class="col-md-4">
                                                        <label for="servico_id" class="form-label">Serviço:</label>
                                                        <select name="servico_id" class="form-select" id="servico_id">
                                                                <option value="">Selecione...</option>
                                                                @foreach($servicos as $servico)
                                                                <option value="{{ $servico['id'] }}" {{ (isset($agendamento) && $agendamento['servicos_id'] == $servico['id']) ? 'selected' : '' }}>
                                                                        {{ $servico['nome_servico']}}
                                                                </option>
                                                                @endforeach
                                                        </select>
                                                </div>
                                        </div>
                                        <div class="row mb-3">
                                                <div class="col-md-12">
                                                        <label for="nome_cliente" class="form-label">Nome do Cliente:</label>
                                                        <input name="nome_cliente" type="text" class="form-control" id="nome_cliente" placeholder="Nome do Cliente" value="{{ old('nome_cliente', $agendamento['nome_cliente'] ?? '') }}">
                                                </div>
                                        </div>
                                        <div class="row mb-3">
                                                <div class="col-md-4">
                                                        <label for="data" class="form-label">Data:</label>
                                                        <input name="data" type="date" class="form-control" id="data" value="{{ old('data', $agendamento['data'] ?? '') }}">
                                                </div>
                                                <div class="col-md-4">
                                                        <label for="horaInicio" class="form-label">Hora Início:</label>
                                                        <input name="horaInicio" type="time" class="form-control" id="horaInicio" value="{{ old('horaInicio', $agendamento['horaInicio'] ?? '') }}">
                                                </div>
                                                <div class="col-md-4">
                                                        <label for="horaFim" class="form-label">Hora Fim:</label>
                                                        <input name="horaFim" type="time" class="form-control" id="horaFim" value="{{ old('horaFim', $agendamento['horaFim'] ?? '') }}">
                                                </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-2">{{ isset($agendamento['id']) ? 'Atualizar' : 'Salvar' }}</button>
                                                <a href="javascript:window.close();" class="btn btn-danger">Cancelar</a>
                                        </div>
                                </form>
                        </div>
                </div>
        </div>
</div>
@endsection