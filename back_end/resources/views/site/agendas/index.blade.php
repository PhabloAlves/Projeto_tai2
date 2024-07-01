@extends('layouts.app')

@section('title', 'Agenda - Marca Aí')

@section('header', 'Agenda')

@section('content')
<table>
    <thead>
        <tr>
            <th>Data</th>
            <th>Horário</th>
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
                    var currentDateTime = new Date();
                    var endDateTime = new Date(`${agendamento.Data.split('/').reverse().join('-')}T${agendamento.hora_fim}`);
                    
                    var statusText;
                    var statusClass;

                    if (agendamento.Status === 0) {
                        statusText = 'Cancelado';
                        statusClass = 'cancel';
                    } else if (endDateTime < currentDateTime) {
                        statusText = 'Serviço Finalizado';
                        statusClass = 'done';
                    } else {
                        statusText = 'Confirmado';
                        statusClass = 'confirm';
                    }

                    var row = `<tr>
                        <td>${agendamento.Data}</td>
                        <td>${agendamento.hora_inicio}</td>
                        <td>${agendamento.Cliente}</td>
                        <td>${agendamento.Nome}</td>
                        <td class="${statusClass}">${statusText}</td>
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

<style>
    .confirm {
        color: green; 
    }

    .cancel {
        color: red; 
    }

    .done {
        color: grey; 
    }


</style>
@endsection
