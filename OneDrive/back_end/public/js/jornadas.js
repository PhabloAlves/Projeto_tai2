$(document).ready(function () {
    tabelaJornadasInit();

    // $('#jornadaForm').submit(function (event) {
    //     event.preventDefault();

    //     $.ajax({
    //         type: $(this).attr('method'),
    //         url: $(this).attr('action'),
    //         data: $(this).serialize(),
    //         success: function (response) {
    //             window.close();
    //         }
    //     });
    // });

    $('#diaSemana').select2({
        placeholder: "Selecione...",
        allowClear: true
    });

    $('#selectAllDays').on('click', function () {
        var allOptions = $('#diaSemana option').map(function () {
            return $(this).val();
        }).get();
        $('#diaSemana').val(allOptions).trigger('change');
    });

    $('#diaSemana').on('change', function () {
        if (($(this).val()).length > 0) {
            $('#diaMes').val(null);
            $('#diaMes').prop('disabled', true);
        } else {
            $('#diaMes').prop('disabled', false);
        }
    });

    $('#diaMes').on('change', function () {
        if (($(this).val()) != '') {
            $('#diaSemana').val(null).trigger('change');
            $('#diaSemana').prop('disabled', true);
            $('#selectAllDays').prop('disabled', true);
        } else {
            $('#diaSemana').prop('disabled', false);
            $('#selectAllDays').prop('disabled', false);
        }
    });

    $('#selectFuncionario').on('change', function () {
        var textFuncionario = $("#selectFuncionario option:selected").text().trim();
        var table = $('#tabelaJornadas').DataTable();

        if (textFuncionario === 'Todos' || textFuncionario === '') {
            table.column(0).search('').draw();
        } else {
            table.column(0).search('^' + textFuncionario + '$', true, false).draw();
        }
    });

    $('#filtroData').on('change', function () {
        var textData = $("#filtroData").val();
        var table = $('#tabelaJornadas').DataTable();

        function formatDate(dateString) {
            var parts = dateString.split('-');
            return parts[2] + '/' + parts[1] + '/' + parts[0];
        }

        var formattedDate = formatDate(textData);

        if (textData === '') {
            table.column(1).search('').draw();
        } else {
            table.column(1).search('^' + formattedDate + '$', true, false).draw();
        }
    });

    $('#selectOperacao').on('change', function () {
        var textOperacao = $("#selectOperacao option:selected").text().trim();
        var table = $('#tabelaJornadas').DataTable();

        if (textOperacao === 'Todos' || textOperacao === '') {
            table.column(4).search('').draw();
        } else {
            table.column(4).search('^' + textOperacao + '$', true, false).draw();
        }
    });
});

function tabelaJornadasInit() {
    var table = $('#tabelaJornadas').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': false,
        'responsive': true,
        'pageLength': 6,
        'destroy': true,
        'columns': [
            { 'data': 'funcionario' },
            { 'data': 'dia' },
            { 'data': 'horaInicio' },
            { 'data': 'horaFim' },
            { 'data': 'operacao' },
            { 'data': 'acao', 'orderable': false, 'searchable': false }
        ],
        'language': {
            'sEmptyTable': 'Nenhum registro encontrado',
            'sInfo': 'Mostrando de _START_ até _END_ de _TOTAL_ registros',
            'sInfoEmpty': 'Mostrando 0 até 0 de 0 registros',
            'sInfoFiltered': '(Filtrados de _MAX_ registros)',
            'sLengthMenu': '_MENU_ resultados por página',
            'sLoadingRecords': 'Carregando...',
            'sProcessing': 'Processando...',
            'sZeroRecords': 'Nenhum registro encontrado',
            'sSearch': 'Pesquisar',
            'oPaginate': {
                'sNext': 'Próximo',
                'sPrevious': 'Anterior',
                'sFirst': 'Primeiro',
                'sLast': 'Último'
            },
            'oAria': {
                'sSortAscending': ': Ordenar colunas de forma ascendente',
                'sSortDescending': ': Ordenar colunas de forma descendente'
            }
        },
    });

    table.draw();
}
