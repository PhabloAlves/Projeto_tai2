$(document).ready(function () {
    $('#funcionarioForm').submit(function (event) {
        event.preventDefault();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (response) {
                // window.close();
            }
        });
    });
});
