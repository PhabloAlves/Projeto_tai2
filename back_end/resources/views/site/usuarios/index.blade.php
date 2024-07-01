@extends('layouts.app')

@section('title', 'Usuários - Marca Aí')

@section('header', 'Cadastro | Usuário')

@section('content')
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody id="users-table-body">
        <!-- Os dados serão preenchidos aqui -->
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $.ajax({
            url: '/users_dados',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var tableBody = $('#users-table-body');
                tableBody.empty();

                data.forEach(function(users) {
                    var row = `<tr>
                        <td>${users.name}</td>
                        <td>${users.email}</td>
                    </tr>`;

                    tableBody.append(row);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Erro ao buscar os dados: ' + textStatus);
            }
        });
    });
</script>
@endsection