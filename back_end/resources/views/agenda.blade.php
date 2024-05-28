@extends('layouts.app')

@section('title', 'Agenda - Marca Aí')

@section('header', 'Agenda')

@section('content')
<table>
    <thead>
        <tr>
            <th>Data</th>
            <th>Clientes</th>
            <th>Serviço</th>
            <th>Status</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody id="agenda-table-body">
        <!-- Os dados serão preenchidos aqui -->
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $.ajax({
            url: '/agendamento_user',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var tableBody = $('#agenda-table-body');
                tableBody.empty();

                data.forEach(function(agendamento) {
                    var statusClass = agendamento.Status === 1 ? 'confirm' : 'cancel'; // Supondo que Status seja 1 para confirmado e 0 para cancelado

                    var row = `<tr>
                        <td>${agendamento.Data}</td>
                        <td>${agendamento.Cliente}</td>
                        <td>${agendamento.Nome}</td>
                        <td class="${statusClass}">${agendamento.Status === 1 ? 'Confirmado' : 'Cancelado'}</td>
                        <td>R$ ${agendamento.Valor}</td>
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
