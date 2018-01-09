$(function(){
    
    var table = $("#table").dataTable();

    table.css("cursor", "pointer").on('click', '.spnStatus', function () {
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
    
    table.css("cursor", "pointer").on('click', '.btnDelete', function () {
        $.ajax({
            url: "updateStatus/",
            method: "POST",
            data: {
                cod: $(this).attr("cod"),
                novoStatus: -1
            },
            success: function (response) {
                if(response === "OK"){
                    location.reload();
                }else{
                    swal("Algo deu errado",response,"error");
                }
            }
        });
    });
    
    table.css("cursor", "pointer").on("click", '.btnObservacao', function(){
        cod = $(this).attr("cod");
        window.location.replace(window.location + "observacao/" + cod);
    });
    
});