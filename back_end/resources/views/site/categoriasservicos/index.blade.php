@extends('layouts.app')

@section('title', 'Cat. Serviços - Marca Aí')

@section('header', 'Cadastro | Categoria de Serviços')

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
                <a href="{{ route('categoriasServicos.create') }}" class="btn btn-primary" target="_blank">Novo</a>
            </div>
        </div>
        <div class="row">
            <div class="col bg-light">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome da Categoria</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->nome_categoria }}</td>
                            <td>
                                <a href="{{ route('categoriasServicos.create', $categoria->id) }}" target="_blank" class="text-primary"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('categoriasServicos.delete', $categoria->id) }}" method="POST" style="display: inline;">
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