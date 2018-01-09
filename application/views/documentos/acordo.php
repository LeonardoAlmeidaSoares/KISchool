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
        <script src="<?= base_url("assets/plugins/ckeditor/ckeditor.js"); ?>" type="text/javascript"></script>
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
                <h1>ACORDO</h1>
                <div class="subTitulo">MURIAÉ, <?= date('d', time()) . " DE " . strtoupper(strftime('%B', time()) . " DE " . date('Y', time())); ?></div>
            </div>
            <div class="textoDesc" id="txtArea"  contenteditable="true">
                O sr. <?= $dados->NomeResponsavel;?>, responsável pelo aluno(a) <?= $dados->nome;?>, 
                contrato de número <?= str_pad($dados->codContrato, 6, "0", STR_PAD_LEFT);?>, veio nesta data renegociar as parcelas restantes para efetuar o cancelamento. 
                Foi pago hoje o valor de R$ XXX,XX reais e faltarão R$ XXX,XX reais a serem pagos dia XX/XX/XXXX. 
                Cordialmente,
            </div>

            <div class="div_assinatura1">
                <hr class="linhaAssinatura" />
                MAURICIO CORREIA DA SILVA
            </div>

            <div class="div_assinatura2">
                <hr class="linhaAssinatura" />
                <?= mb_convert_case($_SESSION["inst_data"]->descricao, MB_CASE_UPPER, 'UTF-8'); ?><br>
                <?= mb_convert_case($_SESSION["user_data"]->nome, MB_CASE_UPPER, 'UTF-8'); ?>
            </div>
            <br><Br>
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
    #imprime_ai_mano{position: fixed;right: 1%;top: 10px;color: #00aae5;cursor: pointer;}
    .textoDesc{margin: 60px 20px 10px 20px; font-family: "Arial"; font-size: 18px;text-align: justify;}
    .div_assinatura1{margin-top: 200px;width: 80%;margin-left: 10%;text-align: center; }
    .div_assinatura2{margin-top:  80px;width: 80%;margin-left: 10%;text-align: center; }
    .rodape{position: absolute;width: 98%;text-align: center; bottom:0px; visibility: hidden;}
    #div_menu{position: fixed;width: 35%;background-color: rgba(0,0,0,0.3);right: 0px;min-height: 98%;text-align: right;border: 1px inset #eee;text-align:center;}
    @media print{.no-print, .no-print *{display: none !important;} .rodape{visibility: visible;}}
    .btn{border-radius: 3px;box-shadow: none; border: 1px solid transparent;background-color: #3c8dbc; border-color: #367fa9; margin-right: 17px;color: #fff;float: right!important;background-image: none; cursor: pointer;display: inline-block; padding: 6px 12px;margin-bottom: 0;font-size: 14px;font-weight: 400;line-height: 1.42857143;text-align: center;white-space: nowrap;vertical-align: middle;}
</style>
<script>
    $(function () {
        
        $("#btnPrint").on("click",function () {
            window.print();
        });
        
        CKEDITOR.inline('txtArea');
    });
</script>