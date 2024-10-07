$(document).ready(function () {
    var allData = []; // Armazena todos os agendamentos recebidos

    // Função para filtrar e renderizar a tabela com base nos filtros selecionados
    function filterAndRenderTable(selectedDate, selectedServico, selectedFuncionario, selectedStatus) {
        var filteredData = allData;

        // Filtrar por data
        if (selectedDate) {
            filteredData = filteredData.filter(function (agendamento) {
                // Transforma a data para o mesmo formato para comparação
                var agendamentoData = new Date(agendamento.Data).toISOString().split('T')[0];
                return agendamentoData === selectedDate;
            });
        }

        // Filtrar por serviço
        if (selectedServico) {
            filteredData = filteredData.filter(function (agendamento) {
                return agendamento.Nome === selectedServico;
            });
        }

        // Filtrar por funcionário
        if (selectedFuncionario) {
            filteredData = filteredData.filter(function (agendamento) {
                return agendamento.Funcionario === selectedFuncionario;
            });
        }

        // Filtrar por status
        if (selectedStatus) {
            filteredData = filteredData.filter(function (agendamento) {
                return agendamento.Status === selectedStatus;
            });
        }

        var tableBody = $('#agenda-table-body');
        tableBody.empty();
        filteredData.forEach(function (agendamento) {
            var statusOptions = `
                <select class="status-select form-select" data-id="${agendamento.id}" id="selectStatus">
                    <option value="0" ${agendamento.Status == 0 ? 'selected' : ''}>Agendado</option>
                    <option value="1" ${agendamento.Status == 1 ? 'selected' : ''}>Confirmado</option>
                    <option value="2" ${agendamento.Status == 2 ? 'selected' : ''}>Serviço Finalizado</option>
                    <option value="3" ${agendamento.Status == 3 ? 'selected' : ''}>Cancelado</option>
                </select>`;

            var row = `<tr>
                <td>${agendamento.Data}</td>
                <td>${agendamento.hora_inicio}</td>
                <td>${agendamento.Cliente}</td>
                <td>${agendamento.Nome}</td>
                <td>${agendamento.Funcionario}</td>
                <td>${statusOptions}</td>
                <td>R$ ${agendamento.Valor}</td>
            </tr>`;

            tableBody.append(row);
        });
    }

    // Carregar dados via AJAX
    $.ajax({
        url: '/agendamentos_dados',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            allData = data;

            // Renderizar a tabela inicial com todos os dados
            filterAndRenderTable();

            // Obter todas as opções únicas para preencher os selects
            var uniqueServicos = [...new Set(data.map(item => item.Nome))];
            var uniqueFuncionarios = [...new Set(data.map(item => item.Funcionario))];
            var uniqueStatuses = ['Confirmado', 'Concluído', 'Cancelado'];

            // Preencher o select de serviços
            uniqueServicos.forEach(function (servico) {
                var option = `<option value="${servico}">${servico}</option>`;
                $('#servico-filter-select').append(option);
            });

            // Preencher o select de funcionários
            uniqueFuncionarios.forEach(function (funcionario) {
                var option = `<option value="${funcionario}">${funcionario}</option>`;
                $('#funcionario-filter-select').append(option);
            });

            // Preencher o select de status
            uniqueStatuses.forEach(function (status) {
                var option = `<option value="${status}">${status}</option>`;
                $('#status-filter-select').append(option);
            });

            // Eventos de mudança nos filtros
            $('#data-filter-input').on('change', function () {
                var selectedDate = $(this).val();
                filterAndRenderTable(selectedDate, $('#servico-filter-select').val(), $('#funcionario-filter-select').val(), $('#status-filter-select').val());
            });

            $('#servico-filter-select').on('change', function () {
                var selectedServico = $(this).val();
                filterAndRenderTable($('#data-filter-input').val(), selectedServico, $('#funcionario-filter-select').val(), $('#status-filter-select').val());
            });

            $('#funcionario-filter-select').on('change', function () {
                var selectedFuncionario = $(this).val();
                filterAndRenderTable($('#data-filter-input').val(), $('#servico-filter-select').val(), selectedFuncionario, $('#status-filter-select').val());
            });

            $('#status-filter-select').on('change', function () {
                var selectedStatus = $(this).val();
                filterAndRenderTable($('#data-filter-input').val(), $('#servico-filter-select').val(), $('#funcionario-filter-select').val(), selectedStatus);
            });

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Erro ao buscar os dados: ' + textStatus);
        }
    });

    $('#agenda-table-body').on('change', '.status-select', function () {
        var newStatus = $(this).val();
        var agendamentoId = $(this).data('id');
        var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Obtém o token CSRF


        $.ajax({
            url: '/agendamentos/' + agendamentoId + '/update-status',  // URL correta para a rota de atualização
            method: 'POST',
            data: {
                _token: csrfToken, // Inclui o token CSRF
                Status: newStatus
            },
            success: function (response) {
                // showInfo('teste');
                alert('Status atualizado com sucesso!');
            },
            error: function (xhr) {
                alert('Erro ao atualizar o status. Por favor, tente novamente.');
                console.error(xhr.responseText);
            }
        });
    });
});
