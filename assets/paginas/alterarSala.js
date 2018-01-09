$(function () {
    
    $("#btnSave").hide();
    
    var codSala = $("#txtSalaAtual").val();
    
    $("#btnSave").on("click", function(){
        
        var codTurma = parseInt($("#codTurma").val());
        
        $.ajax({
            url: "../novaSala/",
            method: "POST",
            data: {
                "codTurma": codTurma,
                "codSala": codSala
            },
            success: function (response) {
                swal("Parábens", "Alterado com sucesso", "success");
            }
        });
    });
    
    $(".imgPorta").on("click", function () {

        codSala = parseInt($(this).attr("codSala"));
        var codTurma = parseInt($("#codTurma").val());

        var $this = $(this);

        $.ajax({
            url: "../../sala/getDadosSala/",
            method: "POST",
            data: {
                "codTurma": codTurma,
                "codSala": codSala
            },
            success: function (response) {

                $(".imgDoor").attr("src", "../../../assets/images/door.png");
                $this.find("img").attr("src", "../../../assets/images/door2.png");
                
                $("#btnSave").show();

                var vet = JSON.parse(response);

                if (vet.length > 0) {

                    $("#descSala").html(vet[0].descricao);

                    $.each(vet, function (index, value) {
                        //console.debug(value);
                        $("#listaUsosSala").append(
                                $("<dt>")
                                .addClass('itemRemovivel')
                                .html(value.diaLetivo + " - " + value.horario)
                                ).append(
                                $("<dd>")
                                .addClass('itemRemovivel')
                                .html(value.turma + "<br><br>")
                                );
                    });
                }else{
                    //console.debug($this);
                    $(".itemRemovivel").hide();
                    $("#descSala").html($this.attr("nomeSala"));
                    
                }

            }
        });

    });
});