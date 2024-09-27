$(document).ready(function () {
    $("#inscricao").inputmask("999.999.999-99");
    $("#telefone").inputmask("(99)99999-9999");
    $("#cep ").inputmask("99999-999");

    $('#tipoInscricao').on('change', function () {
        if ($(this).val() == 1) {
            $("#inscricao").inputmask("99.999.999/9999-99");
        } else {
            $("#inscricao").inputmask("999.999.999-99");
        }
    });
});
