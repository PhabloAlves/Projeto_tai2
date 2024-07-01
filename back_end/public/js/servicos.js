$(document).ready(function () {
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
});
