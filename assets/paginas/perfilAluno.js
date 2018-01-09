$(function () {

    if (window.location.hash) {
        var hash = $.trim(window.location.hash);
        if (hash)
            $('.nav-tabs-custom a[href$="' + hash + '"]').trigger('click');
    }

    $("table").dataTable();

    $("#btn_cancelar_contrato").on("click", function () {

        $cod = $("#codAluno").val();

        if (parseInt($("#perm_diretor").val()) < 2) {

            swal({
                title: 'Tem certeza?',
                text: "Esse cancelamento terá de ser homologado antes de surtir efeito",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Efetuar Cancelamento?',
                cancelButtonText: 'Não Desejo Cancelar?'
            }).then(function () {

                $.ajax({
                    url: "../cancelarContrato",
                    method: "POST",
                    data: {
                        codigo: $cod
                    },
                    success: function (response) {
                        swal('Cencelado', 'Basta esperar pela homologação, e voce será avisado', 'success');
                    }
                });

            });
        } else {
            swal({
                title: 'Tem certeza?',
                text: "Essa operação não pode ser desfeita",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, irei cancele',
                cancelButtonText: 'Não vou cacelar'
            }).then(function () {

                $.ajax({
                    url: "../cancelarContrato",
                    method: "POST",
                    data: {
                        codigo: $cod
                    },
                    success: function (response) {
                        swal('Cencelado', 'O Contrato foi cancelado.', 'success');
                    }
                });

            });
        }
    });

    Highcharts.chart('div_grafico_frequencia', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Frequencia por Módulo'
        },
        xAxis: {
            categories: names
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total de aulas'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: data
    });

});