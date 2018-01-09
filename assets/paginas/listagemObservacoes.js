$(function () {

    $("#div_novo_obs").hide();
    $("#div_ler_obs").hide();

    CKEDITOR.replace("txtMensagem");

    $("#btnCadNovo").on("click", function () {
        
        console.log("Tipo = " + $("#txtTipo").val());
        
        $.ajax({
            url: "../../observacao/cadastrar/",
            method: "POST",
            data: {
                "codigo": $("#txtCodigo").val(),
                "msg": CKEDITOR.instances.txtMensagem.getData(),
                "assunto": $("#txtAssunto").val(),
                "tipo": $("#txtTipo").val()
            },
            success: function (response) {
                console.log(response);
                aux = JSON.parse(response);

                swal({
                    "title": aux["title"],
                    "text": aux["message"],
                    "type": aux["type"]
                }).then(function () {
                    window.location.reload();
                });

                $("#area_trabalho").toggle("slow");
                $("#div_novo_obs").toggle("slow");
                $("#div_ler_obs").hide("slow");
                
            }
        });

    });

    $("#btnNovaMensagem").on("click", function () {
        $("#area_trabalho").hide("slow");
        $("#div_novo_obs").show("slow");
        $("#div_ler_obs").hide("slow");
    });

    $(".clickable-row").on("click", function () {
        
        if($("#txtTipo").val() === "A"){
            $url = "../../observacao/leituraObservacaoAluno/";
        }else{
            $url = "../../observacao/leituraObservacaoProfessor/";
        }
        
        $.ajax({
            url: $url,
            method: "POST",
            data: {
                "codigo": $(this).attr("codItem")
            },
            success: function (response) {

                var dados = JSON.parse(response);

                $("#spanHorario").html(dados[0].data);
                $("#read_message").text(dados[0].texto);
                $("#span_nome_usuario").html("<b>" + dados[0].nome + "</b>");

                $("#area_trabalho").hide("slow");
                $("#div_novo_obs").hide("slow");
                $("#div_ler_obs").show("slow");

            }
        });
    });

    $(".checkbox-toggle").on("click", function () {

        if ($(".quadrado-checado").hasClass("fa-square-o")) {
            $(".quadrado-checado").removeClass("fa-square-o").addClass("fa-check-square-o");
            $(".chk_sel").attr("checked", "checked");
        } else {
            $(".quadrado-checado").removeClass("fa-check-square-o").addClass("fa-square-o");
            $(".chk_sel").removeAttr("checked");
        }
    });

    $(".lixeira").on("click", function () {

        var apagar = [];

        $(".chk_sel").each(function () {
            if ($(this).is(":checked")) {
                apagar.push($(this).val());
            }
        });

        if (apagar.length > 0) {

            var msg = (apagar.length === 1)
                    ? "Quer mesmo apagar essa observação?"
                    : "Quer mesmo apagar tudo isso?";

            swal({
                "title": "Sério?",
                "text": msg,
                "type": "question",
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, vou apagar!',
                cancelButtonText: 'Não, melhor não!'
            }).then(function () {
                $.ajax({
                    url: "../../observacao/inativar/",
                    method: "POST",
                    data: {
                        "codigos": apagar
                    },
                    success: function (response) {
                        var msg = (apagar.length === 1)
                                ? "Mensagem foi deletada com sucesso"
                                : "Mensagens foram apagadas com sucesso";

                        swal("Feito", msg, "success");

                    }
                });
            });
        }else{
            swal("...", "Voce deve selecionar as mensagens antes", "warning");
        }
        //console.debug(apagar);
    });

});