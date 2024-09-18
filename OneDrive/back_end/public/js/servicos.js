$(document).ready(function () {
    tabelaServicosInit();

    $('#servicoForm').submit(function (event) {
        event.preventDefault();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (response) {
                window.close();
            }
        });
    });

    $('#categoria_id').select({
        "language": {
            "noResults": function () {
                return "Nenhum resultado encontrado";
            },
            "searching": function () {
                return "Buscando…";
            }
        },
        ajax: {
            url: 'CategoriasServicosController/select',
            dataType: 'json',
            delay: 250,
        }
    });

    $('#selectCategoria').on('change', function () {
        var textCategoria = $("#selectCategoria option:selected").text().trim();
        var table = $('#tabelaServicos').DataTable();

        if (textCategoria === 'Todos' || textCategoria === '') {
            table.column(0).search('').draw();
        } else {
            table.column(0).search('^' + textCategoria + '$', true, false).draw();
        }
    });

    $('#selectServico').on('change', function () {
        var textServico = $("#selectServico option:selected").text().trim();
        var table = $('#tabelaServicos').DataTable();

        if (textServico === 'Todos' || textServico === '') {
            table.column(1).search('').draw();
        } else {
            table.column(1).search('^' + textServico + '$', true, false).draw();
        }
    });
});

function tabelaServicosInit() {
    var table = $('#tabelaServicos').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': false,
        'responsive': true,
        'pageLength': 6,
        'destroy': true,
        'order': [
            [0, 'asc'],
            [1, 'asc'],
            [2, 'asc']
        ],
        'columns': [
            { 'data': 'nome_categoria' },
            { 'data': 'nome_servico' },
            {
                'data': 'valor',
                'render': function (data) {
                    return data.replace('.', ',');
                }
            },
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
