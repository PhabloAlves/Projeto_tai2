function showError(data) {
    BootstrapDialog.show({
        title: "Erro",
        type: BootstrapDialog.TYPE_DANGER,
        message: data,
        buttons: [
            {
                label: "Fechar",
                cssClass: "btn-primary",
                action: function (dialogItself) {
                    dialogItself.close();
                },
            },
        ],
    });
}

function showInfo(data, titulo = null) {
    BootstrapDialog.show({
        title: titulo ? titulo : "Atenção",
        type: BootstrapDialog.TYPE_INFO,
        message: data,
        buttons: [
            {
                label: "Fechar",
                cssClass: "btn-primary",
                action: function (dialogItself) {
                    dialogItself.close();
                },
            },
        ],
    });
}