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
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                Categoria de Serviço
                                <select id="categoria-filter-select" class="form-select">
                                    <option value="">Todas</option>
                                    <!-- Opções serão inseridas dinamicamente -->
                                </select>
                            </th>
                            <th>
                                Serviço
                                <select id="servico-filter-select" class="form-select">
                                    <option value="">Todos</option>
                                    <!-- Opções serão inseridas dinamicamente -->
                                </select>
                            </th>
                            <th>Valor</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="servico-table-body">
                        @foreach($servicos as $servico)
                        <tr>
                            <td>{{ $servico->nome_categoria }}</td>
                            <td>{{ $servico->nome_servico }}</td>
                            <td>R${{ str_replace('.', ',', $servico->valor) }}</td>
                            <td>
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

<script>
    $(document).ready(function() {
        var allData = []; // Armazena todos os dados dos serviços

        // Função para filtrar e renderizar a tabela com base nos filtros selecionados
        function filterAndRenderTable(selectedCategoria, selectedServico) {
    var filteredData = allData;

    // Filtrar por categoria de serviço
    if (selectedCategoria) {
        filteredData = filteredData.filter(function(servico) {
            return servico.categoria_servico === selectedCategoria; // Atualize aqui
        });
    }

    // Filtrar por serviço
    if (selectedServico) {
        filteredData = filteredData.filter(function(servico) {
            return servico.nome_servico === selectedServico;
        });
    }

    var tableBody = $('#servico-table-body');
    tableBody.empty();

    filteredData.forEach(function(servico) {
        var row = `<tr>
            <td>${servico.categoria_servico}</td> <!-- Atualize aqui -->
            <td>${servico.nome_servico}</td>
            <td>R$ ${servico.valor.replace('.', ',')}</td>
            <td>
                <a href="/servicos/create/${servico.id}" target="_blank" class="text-primary"><i class="fas fa-edit"></i></a>
                <form action="/servicos/delete/${servico.id}" method="POST" style="display: inline;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" style="border: none; background-color: transparent;" class="text-primary"><i style="color: red;" class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>`;

        tableBody.append(row);
    });
}


        // Carregar dados via AJAX
        $.ajax({
            url: '/servicos_dados',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data); // Verifique os dados recebidos
                allData = data;

                // Renderizar a tabela inicial com todos os dados
                filterAndRenderTable();

                // Obter todas as opções únicas para preencher os selects
                var uniqueCategorias = [...new Set(data.map(item => item.nome_categoria))];
                var uniqueServicos = [...new Set(data.map(item => item.nome_servico))];

                // Preencher o select de categorias
                uniqueCategorias.forEach(function(categoria) {
                    var option = `<option value="${categoria}">${categoria}</option>`;
                    $('#categoria-filter-select').append(option);
                });

                // Preencher o select de serviços
                uniqueServicos.forEach(function(servico) {
                    var option = `<option value="${servico}">${servico}</option>`;
                    $('#servico-filter-select').append(option);
                });

                // Eventos de mudança nos filtros
                $('#categoria-filter-select').on('change', function() {
                    var selectedCategoria = $(this).val();
                    filterAndRenderTable(selectedCategoria, $('#servico-filter-select').val());
                });

                $('#servico-filter-select').on('change', function() {
                    var selectedServico = $(this).val();
                    filterAndRenderTable($('#categoria-filter-select').val(), selectedServico);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Erro ao buscar os dados: ' + textStatus);
            }
        });
    });
</script>

@endsection
