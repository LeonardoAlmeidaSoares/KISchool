$(function () {
    var dir = "http://localhost/sites_area/nrandom/admin/index.php/documentacao";
    
    var codContrato = $("#codContrato").val(); 
    
    $("#btnAcordo").on("click", function () {
        $("#AjaxContent").attr("src", dir + "/acordo/" + codContrato);
    });

    $("#btnDeclaracao").on("click", function () {
        $("#AjaxContent").attr("src", dir + "/declaracao/" + codContrato);
    });
    
    $("#btnRescisao").on("click", function () {
        $("#AjaxContent").attr("src", dir + "/rescisao/" + codContrato);
    });
    
    $("#btnTrancamento").on("click", function () {
        $("#AjaxContent").attr("src", dir + "/trancamento/" + codContrato);
    });
    
});