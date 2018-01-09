$(function(){
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
            url: "AlterarStatus/",
            method: "POST",
            data: {
                cod: $(this).attr("cod")
            },
            success: function (response) {
                location.reload();
            }
        });
    });
    
});