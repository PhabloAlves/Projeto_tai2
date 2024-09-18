@extends('layouts.app')

@section('title', 'Serviços - Marca Aí')

@section('header', 'Novo | Serviços')

@section('content')
<div class="container-fluid mt-5">
        <div class="row justify-content-center">
                <div class="col-md-12">
                        <div class="rounded-4 bg-white p-4 mb-4">
                                <form id="servicoForm" action="{{ $servico['id'] ? route('servicos.update', $servico['id']) : route('servicos.store') }}" method="POST">
                                        @csrf
                                        @if(isset($servico['id']))
                                        @method('PUT')
                                        @endif
                                        <div class="row mb-3">
                                                <div class="col-md-4">
                                                        <label for="categoria_id" class="form-label">Categoria de Serviço:</label>
                                                        <select name="categoria_id" class="form-select" id="categoria_id">
                                                                <option value="">Selecione...</option>
                                                                @foreach($categorias as $categoria)
                                                                <option value="{{ $categoria['id'] }}" {{ (isset($servico) && $servico->categorias_servicos_id == $categoria['id']) ? 'selected' : '' }}>
                                                                        {{ $categoria['nome_categoria'] }}
                                                                </option>
                                                                @endforeach
                                                        </select>
                                                </div>
                                                <div class="col-md-4">
                                                        <label for="nome_servico" class="form-label">Serviço:</label>
                                                        <input name="nome_servico" type="text" class="form-control" id="nome_servico" placeholder="Serviço" value="{{ old('nome_servico', $servico['nome_servico'] ?? '') }}">
                                                </div>
                                                <div class="col-md-4">
                                                        <label for="valor" class="form-label">Valor:</label>
                                                        <input name="valor" type="text" class="form-control" id="valor" placeholder="R$00,00" value="{{ old('valor', $servico['valor'] ?? '') }}">
                                                </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-2">{{ isset($servico['id']) ? 'Atualizar' : 'Salvar' }}</button>
                                                <a href="javascript:window.close();" class="btn btn-danger">Cancelar</a>
                                        </div>
                                </form>
                        </div>
                </div>
        </div>
</div>
@endsection