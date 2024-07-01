@extends('layouts.app')

@section('title', 'Cat. Serviços - Marca Aí')

@section('header', 'Cadastro | Categoria de Serviços')

@section('content')
<div class="container-fluid mt-5">
        <div class="row justify-content-center">
                <div class="col-md-12">
                        <div class="rounded-4 bg-white p-4 mb-4">
                                <form id="categoriaForm" action="{{ $categoria['id'] ? route('categoriasServicos.update', $categoria['id']) : route('categoriasServicos.store') }}" method="POST">
                                        @csrf
                                        @if(isset($categoria['id']))
                                        @method('PUT')
                                        @endif
                                        <div class="col-md-8">
                                                <label for="nome_categoria" class="form-label">Categoria de Serviço:</label>
                                                <input name="nome_categoria" type="text" class="form-control" id="nome_categoria" placeholder="Categoria de Serviço" value="{{ old('nome_categoria', $categoria['nome_categoria'] ?? '') }}">
                                        </div>
                                        <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-2">{{ isset($categoria['id']) ? 'Atualizar' : 'Salvar' }}</button>
                                                <a href="javascript:window.close();" class="btn btn-danger">Cancelar</a>
                                        </div>
                                </form>
                        </div>
                </div>
        </div>
</div>
@endsection