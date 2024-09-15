@extends('layouts.app')

@section('title', 'Funcionários - Marca Aí')

@section('header', 'Funcionários')

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
            <a href="{{ route('funcionarios.create') }}" class="btn btn-primary" target="_blank">Novo</a>
        </div>
    </div>
    <div class="row">
        <div class="col bg-light">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome
                            <select id="nome-filter-select" class="form-select">
                                <option value="">Todos</option>
                                <!-- Opções serão inseridas dinamicamente -->
                            </select>
                        </th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="funcionarios-table-body">
                    @foreach($funcionarios as $funcionario)
                    <tr>
                        <td>{{ $funcionario->nome }} {{ $funcionario->sobrenome }}</td>
                        <td>{{ $funcionario->telefone }}</td>
                        <td>
                            <a href="{{ route('funcionarios.create', $funcionario->id) }}" target="_blank" class="text-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('funcionarios.delete', $funcionario->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border: none; background-color: transparent;" class="text-primary"><i style="color: red;" class="fas fa-trash" ></i></button>
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

<script>
    $(document).ready(function() {
    var allFuncionarios = @json($funcionarios);

    // Função para filtrar e renderizar a tabela com base no nome selecionado
    function filterAndRenderTable(selectedNome = '') {
        var filteredFuncionarios = allFuncionarios;

        // Filtrar por nome, se um nome for selecionado
        if (selectedNome) {
            filteredFuncionarios = filteredFuncionarios.filter(function(funcionario) {
                return (funcionario.nome + ' ' + funcionario.sobrenome).toLowerCase().includes(selectedNome.toLowerCase());
            });
        }

        var tableBody = $('#funcionarios-table-body');
        tableBody.empty();

        // Renderizar os dados filtrados na tabela
        filteredFuncionarios.forEach(function(funcionario) {
            var row = `<tr>
                <td>${funcionario.nome} ${funcionario.sobrenome}</td>
                <td>${funcionario.telefone}</td>
                <td>
                    <a href="/funcionarios/${funcionario.id}/edit" target="_blank" class="text-primary"><i class="fas fa-edit"></i></a>
                    <form action="/funcionarios/${funcionario.id}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="border: none; background-color: transparent;" class="text-primary"><i style="color: red;" class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>`;

            tableBody.append(row);
        });
    }

    // Renderizar a tabela inicialmente com todos os dados
    filterAndRenderTable();

    // Evento de mudança no select box de nome
    $('#nome-filter-select').on('change', function() {
        var selectedNome = $(this).val();
        filterAndRenderTable(selectedNome);
    });

    // Obter todas as opções únicas para preencher o select de nome
    var uniqueNomes = [...new Set(allFuncionarios.map(item => item.nome + ' ' + item.sobrenome))];

    uniqueNomes.forEach(function(nome) {
        var option = `<option value="${nome}">${nome}</option>`;
        $('#nome-filter-select').append(option);
    });
});

</script>

@endsection
