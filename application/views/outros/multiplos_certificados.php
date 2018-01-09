<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="<?= base_url("assets/images/favicon.png");?>" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- jQuery 3.1.1 -->
        <script src="<?= base_url("assets/plugins/jQuery/jquery-3.1.1.min.js"); ?>"></script>
        <title>RANDOM - Sistema Administrativo</title>
    </head>
    <body>
        <?php foreach($listaAlunos->result() as $item){ ?>
        <div class="certificado">
            
            <div class='conteudo'>
                <p class='textopadrao linha1'>
                    O CENTRO DE ENSINO RANDOM CERTIFICA QUE
                </p>
                <p class='nomedoInfeliz'>
                    <?= "Nome do Aluno"//$dadosAluno->nome; ?>
                </p>
                <p class='textopadrao linha2'>
                    REALIZOU O SEGUINTE CURSO SEMI-INTENSIVO
                </p>
                <p class='nomeCurso'>
                    <?= "Nome do curso"; //$dadosModulo->descricao; ?>
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
            <br />
        </div>
        <span class="lineG">&nbsp;</span>
        <?php } ?>
    </body>
</html>
<link href="<?= base_url("assets/dist/css/certificados.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/paginas/certificado.js"); ?>" type="text/javascript"></script>
