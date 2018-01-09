$(function () {

    var table = $("#table").dataTable();

    table.on('click', '.spnResolve', function () {
        var cod = $(this).attr("codAluno");
        swal({
            title: 'Como ficou resolvido?',
            text: "o Aluno vai voltar a frequentar as aulas?",
            type: 'question',
            allowEscapeKey: false,
            allowOutsideClick: false,
            allowEnterKey: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, Reativar',
            cancelButtonText: "Não, Cancelar"
        }).then(function () {
            $.ajax({
                url: "../alterarStatus/",
                method: "POST",
                data: {"codAluno": cod, "novoStatus": 1},
                success: function (response) {
                    console.log(response);
                    swal('Prontinho!', 'O Aluno foi novamente ativado', 'success');
                }
            });
        }, function (dismiss) {
            $.ajax({
                url: "../alterarStatus/",
                method: "POST",
                data: {"codAluno": cod, "novoStatus": -1},
                success: function (response) {
                    swal('Que Pena', 'O Contrato do aluno foi cancelado', 'error');
                }
            });
        });
    });

    table.on("click", '.spnRetornar', function () {
        var $this = $(this);
        swal({
            title: 'Retornar Aluno',
            text: "Voce deseja retornar o aluno para a lista de alunos?",
            type: 'question',
            allowEscapeKey: false,
            allowOutsideClick: false,
            allowEnterKey: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
            cancelButtonText: "Não"
        }).then(function () {

            $.ajax({
                url: "../retornarVaga/",
                method: "POST",
                data: {"codAluno": $this.attr("codAluno")},
                success: function (response) {
                    console.log(response);
                    swal('Prontinho!', 'O Aluno foi retornado para a classe', 'success');
                    $this.parents('tr').remove();
                }
            });
        });

    });

    table.on('click', '.spnLiberarVaga', function () {
        var cod = $(this).attr("codAluno");
        swal({
            title: 'Liberação de Vagas',
            text: "Voce deseja liberar a vaga desse aluno?",
            type: 'question',
            allowEscapeKey: false,
            allowOutsideClick: false,
            allowEnterKey: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
            cancelButtonText: "Não"
        }).then(function () {
            $.ajax({
                url: "../liberarVaga/",
                method: "POST",
                data: {"codAluno": cod},
                success: function (response) {
                    console.log(response);
                    swal('Prontinho!', 'A vaga do aluno foi liberada', 'success');
                }
            });
        });
    });
});