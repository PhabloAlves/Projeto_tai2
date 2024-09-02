$(document).ready(function () {
    $('#categoriaForm').submit(function (event) {
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
});
