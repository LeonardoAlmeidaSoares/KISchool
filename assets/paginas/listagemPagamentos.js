myFunction = function (value) {
    console.log("Entrou aqui com o valor" + value);
}

$(function () {

    $("#table").dataTable();

    $('#table tbody').css("cursor", "pointer").on('click', '.spnDelete', function () {
        $.ajax({
            url: "delete/",
            method: "POST",
            data: {
                cod: $(this).attr("cod")
            },
            success: function (response) {
                location.reload();
            }
        });
    });
    $('#table tbody').css("cursor", "pointer").on('click', '.spnStatus', function () {
        $.ajax({
            url: "updateStatus/",
            method: "POST",
            data: {
                cod: $(this).attr("cod"),
                novoStatus: $(this).attr("newValue")
            },
            success: function (response) {
                location.reload();
            }
        });
    });

    $('#table tbody').css("cursor", "pointer").on('click', '.spnDesconto', function () {
        $this = $(this);
        swal({
            title: "Aplicar Desconto?",
            text: "Digite o valor (em Reais) do Desconto",
            input: 'text',
            type: "question",
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aplicar Desconto!',
            cancelButtonText: 'Não Aplicar!',
            inputValidator: function (value) {
                value = value.replace(",", ".");
                return new Promise(function (resolve, reject) {
                    if ((value.length > 0) && (!isNaN(value))) {
                        $.ajax({
                            url: "criarDesconto/",
                            method: "POST",
                            data: {
                                cod: $this.attr("cod"),
                                valor: value
                            },
                            success: function (response) {
                                location.reload();
                            }
                        });
                    } else {
                        reject('Digite um valor ou selecione \"Não Aplicar\"!')
                    }
                });
            }
        }).then(function (valor) {
            alert(valor);
        });
    });

});