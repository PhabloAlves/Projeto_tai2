@extends('layouts.app')

@section('title', 'Funcionários - Marca Aí')

@section('header', 'Cadastro | Funcionário')

@section('content')

<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="rounded-4 bg-white p-4 mb-4">
                <form id="funcionarioForm" action="{{ $funcionario['id'] ? route('funcionarios.update', $funcionario['id']) : route('funcionarios.store') }}" method="POST">
                    @csrf
                    @if(isset($funcionario['id']))
                    @method('PUT')
                    @endif
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nome" class="form-label">Nome:</label>
                            <input name="nome" type="text" class="form-control" id="nome" placeholder="Nome" value="{{ old('nome', $funcionario['nome'] ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="sobrenome" class="form-label">Sobrenome:</label>
                            <input name="sobrenome" type="text" class="form-control" id="sobrenome" placeholder="Sobrenome" value="{{ old('sobrenome', $funcionario['sobrenome'] ?? '') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="dataNascimento" class="form-label">Data de Nascimento:</label>
                            <input name="dataNascimento" type="date" class="form-control" id="dataNascimento" value="{{ old('data_nascimento', $funcionario['data_nascimento'] ?? '') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="tipoInscricao" class="form-label">Tipo de Inscrição:</label>
                            <select name="tipoInscricao" class="form-select" id="tipoInscricao">
                                <option value="">Selecione...</option>
                                <option value="1" {{ old('tipoInscricao', $funcionario['tipo_inscricao'] ?? '') == 1 ? 'selected' : '' }}>CNPJ</option>
                                <option value="2" {{ old('tipoInscricao', $funcionario['tipo_inscricao'] ?? '') == 2 ? 'selected' : '' }}>CPF</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="inscricao" class="form-label">Inscrição:</label>
                            <input name="inscricao" type="text" class="form-control" id="inscricao" value="{{ old('inscricao', $funcionario['inscricao'] ?? '') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="telefone" class="form-label">Telefone:</label>
                            <input name="telefone" type="text" class="form-control" id="telefone" value="{{ old('telefone', $funcionario['telefone'] ?? '') }}">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mr-2">{{ isset($funcionario['id']) ? 'Atualizar' : 'Salvar' }}</button>
                        <a href="javascript:window.close();" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection