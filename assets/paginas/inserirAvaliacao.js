$(function () {

    CKEDITOR.replace("txtDescricao");

    $('#txtData').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: true,
        language: "pt-BR",
        orientation: "top auto"
    });

});

