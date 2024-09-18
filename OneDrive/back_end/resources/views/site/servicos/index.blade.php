@extends('layouts.app')

@section('title', 'Serviços - Marca Aí')

@section('header', 'Cadastro | Serviços')

@section('content')
<div class="container mt-5">
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

    <div class="rounded-4 bg-light p-4 mb-4">
        <div class="row justify-content-end mb-3">
            <div class="col-auto">
                <a href="{{ route('servicos.create') }}" class="btn btn-primary" target="_blank">Novo</a>
            </div>
        </div>
        <div class="row">
            <div class="col bg-light">
                <table class="table" id="tabelaServicos">
                    <thead>
                        <tr>
                            <th colspan="4">
                                Categoria de Serviço
                                <select id="selectCategoria" class="form-select">
                                    <option value="">Todos</option>
                                    @foreach($selectCategorias as $categoria)
                                    <option value="{{ $categoria['id'] }}">
                                        {{ $categoria['nome_categoria'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </th>
                            <th colspan="4">
                                Serviço
                                <select id="selectServico" class="form-select">
                                    <option value="">Todos</option>
                                    @foreach($selectServicos as $servico)
                                    <option value="{{ $servico['id'] }}">
                                        {{ $servico['nome_servico'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </th>
                            <th colspan="2">Valor</th>
                            <th colspan="2">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="servico-table-body">
                        @foreach($servicos as $servico)
                        <tr>
                            <td colspan="4">{{ $servico->nome_categoria }}</td>
                            <td colspan="4">{{ $servico->nome_servico }}</td>
                            <td colspan="2">R${{ str_replace('.', ',', $servico->valor) }}</td>
                            <td colspan="2">
                                <a href="{{ route('servicos.create', $servico->id) }}" target="_blank" class="text-primary"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('servicos.delete', $servico->id) }}" method="POST" style="display: inline;">
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