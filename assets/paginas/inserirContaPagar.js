$(function(){
    
    $("#txtVencimento").mask("99/99/9999");
    $("#txtValor").mask('000.000.000.000.000,00', {reverse: true});
    
    CKEDITOR.replace("txtObservacao");
    
});