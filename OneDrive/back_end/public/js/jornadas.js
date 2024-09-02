$(document).ready(function () {
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
});
