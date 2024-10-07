@extends('layouts.app')

@section('title', 'Jornadas - Marca Aí')

@section('header', 'Cadastro | Jornadas')

@section('content')
<style>
        .select2-selection__choice {
                background-color: #3f60d7 !important;
                /* Cor de fundo personalizada */
                color: white !important;
                /* Cor do texto personalizada */
        }

        .select2-selection__choice__remove {
                color: white !important;
                /* Cor do ícone de remoção personalizada */
        }
</style>

<div class="container-fluid mt-5">
        <div class="row justify-content-center">
                <div class="col-md-12">
                        <div class="rounded-4 bg-white p-4 mb-4">
                                <form id="jornadaForm" action="{{ $jornada['id'] ? route('jornadas.update', $jornada['id']) : route('jornadas.store') }}" method="POST">
                                        @csrf
                                        @if(isset($jornada['id']))
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
                                                                <option value="{{ $funcionario['id'] }}" {{ (isset($jornada) && $jornada['funcionarios_id'] == $funcionario['id']) ? 'selected' : '' }}>
                                                                        {{ $funcionario['nome'] . ' ' . $funcionario['sobrenome'] }}
                                                                </option>
                                                                @endforeach
                                                        </select>
                                                </div>
                                                <div class="col-md-4">
                                                        <label for="operacao" class="form-label">Operação:</label>
                                                        <select name="operacao" class="form-select" id="operacao">
                                                                <option value="">Selecione...</option>
                                                                <option value="0" {{ isset($jornada) && $jornada['operacao'] === 0 ? 'selected' : '' }}>Adição</option>
                                                                <option value="1" {{ isset($jornada) && $jornada['operacao'] === 1 ? 'selected' : '' }}>Subtração</option>
                                                        </select>
                                                </div>
                                        </div>
                                
                                        <div class="row mb-3">
                                                <div class="col-md-12">
                                                        <label for="diaSemana" class="form-label">Dia da Semana:</label>
                                                        <div class="input-group">
                                                                <select name="diaSemana[]" class="form-select select2" id="diaSemana" multiple="multiple">
                                                                        <option value="1" {{ isset($jornada) && $jornada['diaSemana'] !== null && in_array(1, explode(',', $jornada['diaSemana'])) ? 'selected' : '' }}>Segunda-Feira</option>
                                                                        <option value="2" {{ isset($jornada) && $jornada['diaSemana'] !== null && in_array(2, explode(',', $jornada['diaSemana'])) ? 'selected' : '' }}>Terça-Feira</option>
                                                                        <option value="3" {{ isset($jornada) && $jornada['diaSemana'] !== null && in_array(3, explode(',', $jornada['diaSemana'])) ? 'selected' : '' }}>Quarta-Feira</option>
                                                                        <option value="4" {{ isset($jornada) && $jornada['diaSemana'] !== null && in_array(4, explode(',', $jornada['diaSemana'])) ? 'selected' : '' }}>Quinta-Feira</option>
                                                                        <option value="5" {{ isset($jornada) && $jornada['diaSemana'] !== null && in_array(5, explode(',', $jornada['diaSemana'])) ? 'selected' : '' }}>Sexta-Feira</option>
                                                                        <option value="6" {{ isset($jornada) && $jornada['diaSemana'] !== null && in_array(6, explode(',', $jornada['diaSemana'])) ? 'selected' : '' }}>Sábado</option>
                                                                        <option value="0" {{ isset($jornada) && $jornada['diaSemana'] !== null && in_array(0, explode(',', $jornada['diaSemana'])) ? 'selected' : '' }}>Domingo</option>
                                                                </select>
                                                                <div class="input-group-append">
                                                                        <button type="button" class="btn btn-outline-dark" id="selectAllDays">
                                                                                <i class="fas fa-plus"></i>
                                                                        </button>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                                <div class="col-md-4">
                                                        <label for="diaMes" class="form-label">Dia do Mês:</label>
                                                        <input name="diaMes" type="date" class="form-control" id="diaMes" value="{{ old('diaMes', $jornada['diaMes'] ?? '') }}">
                                                </div>
                                                <div class="col-md-4">
                                                        <label for="horaInicio" class="form-label">Hora Início:</label>
                                                        <input name="horaInicio" type="time" class="form-control" id="horaInicio" value="{{ old('horaInicio', $jornada['horaInicio'] ?? '') }}">
                                                </div>
                                                <div class="col-md-4">
                                                        <label for="horaFim" class="form-label">Hora Fim:</label>
                                                        <input name="horaFim" type="time" class="form-control" id="horaFim" value="{{ old('horaFim', $jornada['horaFim'] ?? '') }}">
                                                </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-2">{{ isset($jornada['id']) ? 'Atualizar' : 'Salvar' }}</button>
                                                <a href="javascript:window.close();" class="btn btn-danger">Cancelar</a>
                                        </div>
                                </form>
                        </div>
                </div>
        </div>
</div>
@endsection