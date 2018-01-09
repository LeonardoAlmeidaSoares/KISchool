$(function () {

    var valorTotalContrato = 0;
    var valorMatricula = 50;
    var Horario = "";
    var TotalModulos = 0;

    $.fn.editable.defaults.mode = 'inline';
    $.fn.datepicker.defaults.format = "dd/mm/yyyy";

    var options = {
        symbol: "R$ ",
        decimal: ",",
        thousand: ".",
        precision: 2,
        format: "%s%v"
    };
    
    $(".data").mask("00/00/0000");
    $(".cpf").mask("000.000.000-00");
    $(".celular").mask("(00) 9 0000-0000");
    $(".telefone").mask("(00) 0000-0000");
    $(".cep").mask("00.000-000");

    $('.datepicker').datepicker({
        language: "pt-BR"
    });

    $('#formapagto').editable();

    $("#SpnValorMatricula").editable({
        type: "text",
        url: function(params){
            newValue = parseFloat(params.value.replace(",", "."));
            valorMatricula = newValue;
            $("#txtValorTotalComEntrada").html(accounting.formatMoney(valorTotalContrato + valorMatricula, options));
            $("#txtValorMatriculaPago").val(valorMatricula);
        }
    });

    $("#valorParcelas").editable({
        type: "text",
        url: function (params) {
            newValue = parseFloat(params.value.replace(",", "."));
            $("#valorParcelas").html(accounting.formatMoney(newValue, options));
            $("#txtValorParcela").val(newValue);
            $("#txtValorTotal").html(accounting.formatMoney(newValue * parseInt($('#txtNumParcelas').val()), options));
            $("#txtvalorCompra").val(newValue * parseInt($('#txtNumParcelas').val()));
            valorTotalContrato = parseFloat($("#txtvalorCompra").val());
            $("#txtValorTotal").html(accounting.formatMoney(valorTotalContrato, options));
            $("#txtValorTotalComEntrada").html(accounting.formatMoney(valorTotalContrato + valorMatricula, options));
            $("#tblServicos tbody tr").each(function () {
                $(this).children().next(".tdValor").html(accounting.formatMoney(newValue * parseInt($('#txtNumParcelas').val())/TotalModulos, options));
            });
            
        }
    });

    $('#qtdParcelas').editable({
        type: 'text',
        url: function (params) {
            //console.log(params);
            newValue = parseInt(params.value);
            $("#txtNumParcelas").val(newValue);
            if (valorTotalContrato > 0) {
                valor = valorTotalContrato / newValue;
                $("#valorParcelas").html(accounting.formatMoney(valor, options));
                $("#txtValorParcela").val(valor);
                
            } else {
                swal("Atenção", "Selecione o curso antes de selecionar o número de parcelas", "warning");
            }

        }
    });

    $("#txtSelTurma").on("change", function () {
        $("#txtcodTurma").val($("#txtSelTurma :selected").val());

        $.ajax({
            url: "../turma/getTurma/",
            method: "POST",
            data: {
                "codTurma": $("#txtSelTurma :selected").val()
            },
            success: function (response) {

                var vet = JSON.parse(response);
                
                TotalModulos = 0;
                
                $("#tblServicos tbody tr").each(function () {
                    TotalModulos++;
                    $(this).children().next(".tdHorario").html(vet[0].horario);
                    $(this).children().next(".tddiaLetivo").html(vet[0].diaLetivo);
                    $(this).children().next(".tddataInicio").html(vet[0].dataInicio);
                });

                $("#qtdParcelas").trigger("click");

            }
        });
    });

    $("#txtSelCurso").on("change", function () {

        $codTurma = $("#txtSelCurso :selected").val();

        $.ajax({
            url: "../turma/getTurmasAtivas/",
            method: "POST",
            data: {
                "codCurso": $codTurma
            },
            success: function (response) {

                var vet = JSON.parse(response);
                
                for (var i = 0, len = vet.length; i < len; i++) {
                    $("#txtSelTurma").append(
                            $("<option>")
                            .val(vet[i].codTurma)
                            .html(vet[i].descricao + " " + vet[i].horario)
                            );
                }
            }
        });

        $.ajax({
            url: "../curso/getModulos/",
            method: "POST",
            data: {
                "codCurso": $codTurma
            },
            success: function (response) {

                $("#tblServicos tbody").empty();

                var vet = JSON.parse(response);

                console.debug(vet);

                for (var i = 0, len = vet.length; i < len; i++) {
                    $("#tblServicos tbody").append(
                            $("<tr>").append(
                            $("<td>").addClass("tdDescricao").html(vet[i].descricao)
                            ).append(
                            $("<td>").addClass("tddiaLetivo").html("")
                            ).append(
                            $("<td>").addClass("tdHorario").html(Horario)
                            ).append(
                            $("<td>").addClass("tdValor").html(accounting.formatMoney(vet[i].valor, options))
                            ).append(
                            $("<td>").addClass("tddataInicio").html("")
                            )
                            );
                }

                valorTotalContrato = vet.length * vet[0].valor;

                $("#txtValorTotal").html(accounting.formatMoney(vet.length * vet[0].valor, options));
                $("#txtValorTotalComEntrada").html(accounting.formatMoney((vet.length * vet[0].valor) + 50, options));
                
                $("#txtValorTotal").html(accounting.formatMoney(valorTotalContrato, options));
                $("#txtValorTotalComEntrada").html(accounting.formatMoney(valorTotalContrato + valorMatricula, options));
                $("#txtvalorCompra").val(valorTotalContrato);
                $("#txtcodCurso").val($codTurma);
            }
        });
    });

    $("#btnExchange").on("click", function () {
        swal({
            title: '',
            text: "O Responsável pela matrícula é o próprio aluno?",
            type: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        }).then(function () {
            $("#txtNomeAluno").val($("#txtNome").val());
            $("#txtEmailAluno").val($("#txtEmail").val());
            $("#txtNascimentoAluno").val($("#txtNascimento").val());
            $("#txtcpfAluno").val($("#txtcpf").val());
            $("#txtRgAluno").val($("#txtRg").val());
            $("#txtTelAluno").val($("#txtTel").val());
            $("#txtCelAluno").val($("#txtCel").val());
            $("#txtLogradouroAluno").val($("#txtLogradouro").val());
            $("#txtComplementoAluno").val($("#txtComplemento").val());
            $("#txtBairroAluno").val($("#txtBairro").val());
            $("#txtCidadeAluno").val($("#txtCidade").val());
            $("#txtUFAluno").val($("#txtUF").val());
            $("#txtCepAluno").val($("#txtCep").val());
            $("#txtPaiAluno").val($("#txtPai").val());
            $("#txtMaeAluno").val($("#txtMae").val());
        }, function (dismiss) {});

    });
    
    $("#btnSubmit").on("click", function(evt){
        evt.preventDefaul();
    });
    /*
    $("#txtNome").val("Leo de Teste");
    $("#txtEmail").val("leonardo@qualquercoisa.com.br");
    $("#txtNascimento").val("23/04/1989");
    $("#txtcpf").val("079.141.256-36");
    $("#txtRg").val("MG16.861.616");
    $("#txtTel").val("(32) 8454-1387");
    $("#txtCel").val("(32) 99648-5786");
    $("#txtLogradouro").val("Minha casa");
    $("#txtComplemento").val("teste");
    $("#txtBairro").val("Centro");
    $("#txtCidade").val("Muriaé");
    $("#txtUF").val("Minas Gerais");
    $("#txtCep").val("36.884-040");
    $("#txtPai").val("Florderalde Pereira Soares");
    $("#txtMae").val("Laurentina de Almeida Soares");
    */
});