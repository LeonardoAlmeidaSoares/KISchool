$(function () {
    $("#table").dataTable();
    
    $('#table tbody').on('click', '.glyphicon-send', function () {
        email = $(this).attr("mail");
        $.ajax({
            url: "../../Util/sendEmailAniversario/",
            method: "POST",
            data: {
                email: email
            },
            success: function (response) {
                alert(response);
            }
        });
    });    
});