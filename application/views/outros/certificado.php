<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="shortcut icon" href="<?= base_url("assets/images/favicon.png");?>" />
        <!-- jQuery 3.1.1 -->
        <script src="<?= base_url("assets/plugins/jQuery/jquery-3.1.1.min.js"); ?>"></script>
        <title>RANDOM - Sistema Administrativo</title>
    </head>
    <body>
        <div class="certificado">
            <div class='conteudo'>
                <p class='textopadrao linha1'>
                    O CENTRO DE ENSINO RANDOM CERTIFICA QUE
                </p>
                <p class='nomedoInfeliz'>
                    <?= $dadosAluno->nome; ?>
                </p>
                <p class='textopadrao linha2'>
                    REALIZOU O SEGUINTE CURSO SEMI-INTENSIVO
                </p>
                <p class='nomeCurso'>
                    <?= $dadosModulo->descricao; ?>
                </p>
                <p class='textopadrao linha3'>NO PERÍODO DE 04/04/2017 A 10/10/2017 COM A CARGA HORÁRIA DE 66 HORAS.</p>
                <div class="assinaturas">
                    <div class='linhaAssinatura'>
                        <hr class='assinatura' />
                        <br />
                        <span><b>CAYO MATHEUS FERRO</b> – DIRETOR</span>
                    </div>
                    <div class='linhaAssinatura'>
                        <hr class='assinatura' />
                        <br />
                        <span><b>KAROLYNE FERRO</b> – COORDENADORA</span>
                    </div>

                </div>
                <div class="linhaCNPJ">CNPJ 10.746.358/0001-11</div>
            </div>

            <!--div id="div_menu" class="no-print">

                <div class="div-form">
                    <label>
                        Certificados Disponíveis: 
                    </label>
                    <select class="form-control" id="select_certificado">
                        <option value="0" hidden selected>SELECIONE O DIPLOMA A SER IMPRESSO</option>
                        <?php foreach ($todosOsCertificados->result() as $item) { ?>
                            <option value="<?= $item->codModulo; ?>"><?= $item->descricao; ?></option>
                        <?php } ?>
                    </select>

                </div>

                <br /><br />

                <button id="btnPrint">
                    <i class="fa fa-print"></i> Imprimir
                </button>
                <input type="hidden" name="txtCodAluno" id="txtCodAluno" value="<?= $codAluno;?>" />
                <div class="btnFooter">
                    <button id="btnVoltar">
                        <i class="fa fa-chevron-left"></i> Voltar
                    </button>
                </div>
            </div-->

        </div>
    </body>
</html>
<link href="<?= base_url("assets/dist/css/certificado.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/paginas/certificado.js"); ?>" type="text/javascript"></script>