$(function(){
    
    $("#txtInicio").mask("00/00/0000");
    
    $("#frmCadastro").validate({
        rules: {
            txtNome: {
                required: true,
                minlength: 10
            },
            txtNumVagas: "required",
            txtDiaLetivo: "required",
            txtInicio: "required",
            txtCurso: "required",
            txtProfessor: "required",
            txtEscola: "required",
            txtHorario: "required"
        },
        messages: {
            txtNome: {
                required: "Campo Obrigatório",
                minlength: "Nome muito curto"
            },
            txtNumVagas: "Campo Obrigatório",
            txtDiaLetivo: "Campo Obrigatório",
            txtInicio: "Campo Obrigatório",
            txtCurso: "Campo Obrigatório",
            txtProfessor: "Campo Obrigatório",
            txtEscola: "Campo Obrigatório",
            txtHorario: "Campo Obrigatório"
        }
    });
});