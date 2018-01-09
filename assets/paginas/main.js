$(function () {
    $(".notif").on("click", function (evt) {
        
        evt.preventDefault();
        var codNot = $(this).attr("data-id");
        domain = window.location.hostname;
        
        $.ajax({
            url: "http://" + domain + "/sites_area/nrandom/admin/index.php/util/getNotificacao/",
            method: "POST",
            data: {
                cod: codNot
            },
            success: function (response) {
                var itens = JSON.parse(response);
                swal('AVISO!',itens[0].mensagem,'success');
                $(".numNotificacoes").html(parseInt($(".numNotificacoes").html()) - 1);
            }
        });
        
    })
});