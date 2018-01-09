<?php 
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="<?= base_url("assets/images/favicon.png"); ?>" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- jQuery 3.1.1 -->
        <script src="<?= base_url("assets/plugins/jQuery/jquery-3.1.1.min.js"); ?>"></script>
        <title>RANDOM - Sistema Administrativo</title>
    </head>
    <body>
        <div id="documento">
            <div id="cabecalho">
                <img src="<?= base_url("assets/images/loguinha.png"); ?>" style="width: 100%;"/>
                <div id="imprime_ai_mano" class="no-print">
                    <span class="fa fa-print fa-3x" id="btnPrint" ></span>
                </div>
            </div>
            <div class="titulo">
                <h1>TRANCAMENTO DE MATRÍCULA</h1>
                <div class="subTitulo">MURIAÉ, <?= date('d', time()) . " DE " . strtoupper(strftime('%B', time()) . " DE " . date('Y', time())); ?></div>
            </div>
            <div class="textoDesc">
                O aluno(a) <?= $dados->nome;?>, contrato de número <?= str_pad($dados->codContrato, 6, "0", STR_PAD_LEFT);?>, solicitou hoje o trancamento da matrícula. 
                Já foi cursado um módulo (contabilidade) e este encontra-se pago. 
                O aluno retornará ao curso no módulo de SEGURANÇA DO TRABALHO.
            </div>
            <div class="div_assinatura">
                <hr class="linhaAssinatura" />
                CENTRO DE ENSINO RANDOM MURIAÉ<br>
                LEONARDO ALMEIDA SOARES
            </div>
        </div>
        <div class="rodape">
            AV. MONTEIRO DE CASTRO, 160, BARRA, MURIAÉ – MG | 3728-2363 <br />
            WWW.CURSOSRANDOM.COM.BR | CNPJ.: 10.746.358/0001-11
        </div>
    </body>
</html>

<style>
    #cabecalho{text-align: center;width: 100%;}
    .titulo{text-align: center; margin-top: 50px;}
    .titulo h1{font-size: 30px;text-decoration: underline;}
    .subTitulo{margin-top: -15px;}
    .textoDesc{margin: 60px 20px 10px 20px; font-family: "Arial"; font-size: 18px;text-align: justify;}
    .div_assinatura{margin-top: 200px;width: 80%;margin-left: 10%;text-align: center; }
    #imprime_ai_mano{position: fixed;right: 1%;top: 10px;color: #00aae5;cursor: pointer;}
    .rodape{position: absolute;width: 98%;text-align: center; bottom:0px; visibility: hidden;}
    @media print{.no-print, .no-print *{display: none !important;} .rodape{visibility: visible;}}

</style>
<script src="<?= base_url("assets/plugins/jquery.printElement.min.js");?>" type="text/javascript"></script>
<script>
    $(function(){
        $("#btnPrint").on("click",function () {
            window.print();
        });
    });
</script>