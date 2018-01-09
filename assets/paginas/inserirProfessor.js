$(function(){
    $("#txtNascimento").mask("00/00/0000");
    $("#txtTelefone").mask("(00) 0 0000-0000");
    $("#txtCelular").mask("(00) 0 0000-0000");
    $("#txtCpf").mask("000.000.000-00");
    $("#txtSalario").mask('000.000.000.000.000,00', {reverse: true});
    
    $(".selectType").on("click", function(evt){
        
        evt.preventDefault();
        
        $this = $(this);
        
        $("#txtTipoSalario").val($this.val());
        
        $("#trigger_select_typeSalario").html($this.html() + "&nbsp;<span class='caret'></span");
        
    });
    
    $("#frmCadastro").validate({
        rules: {
            txtNome: {
                required: true,
                minlength: 10
            },
            txtEmail: {
                email: true,
                required: true
            },
            txtNascimento: {
                required: true,
                minlength: 10,
                maxlength: 10
            },
            txtTelefone: "required",
            txtSenha: {
                required: true
            },
            txtCSenha: {
                required: true,
                equalTo: "#txtSenha"
            }
        },
        messages:{
            txtNome: {
                required: "Campo Obrigatório",
                minlength: "Nome muito curto"
            },
            txtEmail: {
                email: "Campo tem que ser um email válido",
                required: "Campo Obrigatório"
            },
            txtNascimento: {
                required: "Campo Obrigatório",
                minlength: "Campo não formatado corretamente",
                maxlength: "Campo não formatado corretamente"
            },
            txtTelefone: "Campo Obrigatório",
            txtSenha: {
                required: "Campo Obrigatório"
            },
            txtCSenha: {
                required: "Campo Obrigatório",
                equalTo: "Senhas não conferem"
            }
        }
    });
    
});