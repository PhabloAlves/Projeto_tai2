@extends('layouts.app')

@section('title', 'Empresa - Marca Aí')

@section('header', 'Cadastro | Empresa')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="rounded-4 bg-light p-4 mb-4"> 
                    <form action="{{ $empresa->exists ? route('empresas.update', $empresa->id) : route('empresas.store') }}" method="POST">
                        @csrf
                        @if($empresa->exists)
                        @method('PUT')
                        @endif
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
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="razaoSocial" class="form-label">Razão Social:</label>
                                <input name="razaoSocial" type="text" class="form-control" id="razaoSocial" placeholder="Razão Social" value="{{ old('razaoSocial', $empresa->razao_social) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="identificacao" class="form-label">Identificação:</label>
                                <input name="identificacao" type="text" class="form-control" id="identificacao" placeholder="Identificação" value="{{ old('identificacao', $empresa->identificacao) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="tipoInscricao" class="form-label">Tipo de Inscrição:</label>
                                <select name="tipoInscricao" class="form-select" id="tipoInscricao">
                                    <option value="">Selecione...</option>
                                    <option value="1" {{ old('tipoInscricao', $empresa->tipo_inscricao) == 1 ? 'selected' : '' }}>CNPJ</option>
                                    <option value="2" {{ old('tipoInscricao', $empresa->tipo_inscricao) == 2 ? 'selected' : '' }}>CPF</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="inscricao" class="form-label">Inscrição:</label>
                                <input name="inscricao" type="text" class="form-control" id="inscricao" value="{{ old('inscricao', $empresa->inscricao) }}">
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">E-mail:</label>
                                <input name="email" type="email" class="form-control" id="email" placeholder="exemplo@exemplo.com" value="{{ old('email', $empresa->email) }}">
                            </div>
                            <div class="col-md-2">
                                <label for="telefone" class="form-label">Telefone:</label>
                                <input name="telefone" type="text" class="form-control" id="telefone" value="{{ old('telefone', $empresa->telefone) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="inputEndereco" class="form-label">Endereço:</label>
                                <input name="endereco" type="text" class="form-control" id="endereco" value="{{ old('endereco', $empresa->endereco) }}">
                            </div>
                            <div class="col-md-4">
                                <label for="bairro" class="form-label">Bairro:</label>
                                <input name="bairro" type="text" class="form-control" id="bairro" value="{{ old('bairro', $empresa->bairro) }}">
                            </div>
                            <div class="col-md-2">
                                <label for="cep" class="form-label">CEP:</label>
                                <input name="cep" type="text" class="form-control" id="cep" value="{{ old('cep', $empresa->cep) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-10">
                                <label for="cidade" class="form-label">Cidade:</label>
                                <input name="cidade" type="text" class="form-control" id="cidade" value="{{ old('cidade', $empresa->cidade) }}">
                            </div>
                            <div class="col-md-2">
                                <label for="uf" class="form-label">UF:</label>
                                <input name="uf" type="text" class="form-control" id="uf" value="{{ old('uf', $empresa->uf) }}">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-2">{{ $empresa->exists ? 'Atualizar' : 'Salvar' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection