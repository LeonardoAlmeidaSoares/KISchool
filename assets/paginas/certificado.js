$(function(){
    $("#btnPrint").on("click", function(){
        window.print();
    });
    
    $("#btnVoltar").on("click", function(){
        window.history.back();
    });
    
    $("#select_certificado").change(function(){
        $.ajax({
            url: "../../getDadosDiploma/",
            method: "POST",
            data: {
                codAluno: $("#txtCodAluno").val(),
                codModulo: $(this).val()
            },
            success: function (response) {
                var itens = JSON.parse(response);
                console.debug(itens);
                if(parseInt(itens[0].status) >= 1001){
                    swal("Atenção", "Voce sabia que esse certificado já foi impresso?", "question");
                }
                
                $(".nomeCurso").html(itens[0].descricao);
                
            }
        });
    });
    
    window.print();
    
});