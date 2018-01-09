$(function () {
    $("#table").dataTable();
    $('#table tbody').css("cursor", "pointer").on('click', '.spnDelete', function () {
    //$(".spnDelete").css("cursor", "pointer").on("click", function () {
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
    //$(".spnStatus").css("cursor", "pointer").on("click", function(){
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
    
});