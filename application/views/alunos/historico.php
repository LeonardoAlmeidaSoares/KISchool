<?php 
function getStatusComprovante($cod){
    
    $return = 0;
    
    switch($cod){
        case COD_STATUS_COMPROVANTE_CRIADO:
            $return = "O Comprovante ainda não foi impresso";
            break;
        case COD_STATUS_COMPROVANTE_GERADO:
            $return = "O Comprovante foi impresso e aguarda entrega";
            break;
        case COD_STATUS_COMPROVANTE_ENTREGUE:
            $return = "O Comprovante foi entregue ao aluno";
            break;
    }
    return $return;
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Alunos
            <small>Histórico de Aluno</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i>Alunos
                </a>
            </li>
            <li class="active">Histórico</li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->
    <section class="content container-fluid">
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> <?= $dadosAluno->nome; ?>
                        <small class="pull-right">Data: <?= date("d/m/Y"); ?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Dados
                    <address>
                        <strong><?= $dadosAluno->nome; ?></strong><br>
                        <?= $dadosAluno->logradouro; ?>, <?= $dadosAluno->complemento; ?><br>
                        <?= $dadosAluno->bairro; ?>, <?= $dadosAluno->cidade; ?><br>
                        Telefone: <?= $dadosAluno->telefone; ?><br>
                        Email: <?= $dadosAluno->email; ?>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Responsável
                    <address>
                        <strong><?= $dadosResponsavel->nome; ?></strong><br>
                        <?= $dadosResponsavel->logradouro; ?>, <?= $dadosResponsavel->complemento; ?><br>
                        <?= $dadosResponsavel->bairro; ?>, <?= $dadosResponsavel->cidade; ?><br>
                        Telefone: <?= $dadosResponsavel->telefone; ?><br>
                        Email: <?= $dadosResponsavel->email; ?>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Contrato #<?= str_pad($dadosContrato->codContrato, 8, "0", STR_PAD_LEFT); ?></b><br>
                    <br>
                    <b>Firmado em:</b> <?= date("d/m/Y", strtotime($dadosContrato->data)); ?><br>
                    <!--b>Payment Due:</b> 2/22/2014<br>
                    <b>Account:</b> 968-34567-->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            
            <?php if($historico->num_rows() > 0){ ?>
            
            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="40%">Certificado</th>
                                <th width="15%">Data de Emissão</th>
                                <th width="35%">Status</th>
                                <th width="10%" class="no-print">Visualizar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($historico->result() as $item) { ?>
                                <tr>
                                    <td><?= $item->descricao; ?></td>
                                    <td><?= date("d/m/Y", strtotime($item->dataEmissaoCertificado)); ?></td>
                                    <td>
                                        <?php 
                                            echo getStatusComprovante($item->status);
                                            if($item->status == COD_STATUS_COMPROVANTE_ENTREGUE){
                                                echo " no dia " . date("d/m/Y", strtotime($item->dataEntregaCertificado)) . " a " . $item->nomeResponsavelPegouComprovante;
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="no-print" href="<?= base_url("index.php/aluno/Certificado/$item->codAluno/$item->codModulo");?>" target="_blank" style="text-decoration: none;color: #000;" >
                                            <span class="fa fa-dashboard"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                            
                            <?php if(!is_null($gerarCertificadoCompleto)){ ?>
                                <tr style="background-color: antiquewhite;border: 2px;font-family: -webkit-pictograph;">
                                    <td>CERTIFICADO COMPLETO - <?= strtoupper($gerarCertificadoCompleto->row(0)->nome); ?></td>
                                    <td>DOWNLOAD DISPONÍVEL</td>
                                    <td></td>
                                    <td>
                                        <a target="_blank" class="no-print" href="<?= base_url("index.php/aluno/CertificadoFinal/" . $historico->row(0)->codAluno . "/" . $gerarCertificadoCompleto->row(0)->codCurso);?>" style="text-decoration: none;color: #000;" >
                                            <span class="fa fa-dashboard"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                                
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <?php } ?>
            
            <?php if($observacoes->num_rows() > 0) { ?>
            
            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 hidden-print">
                    <p class="lead">Observações Cadastradas:</p>
                    <?php foreach ($observacoes->result() as $item) { ?>
                        <span class="clsData"><?= date("d/m/Y", strtotime($item->data)); ?></span>
                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            <?= $item->texto; ?>
                        </p>
                    <?php } ?>
                </div>
                <!-- /.col -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <p class="lead">Dados sobre Frequencia</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width:50%">Total de Aulas:</th>
                                    <?php if($frequencia["totalAulas"] > 0){ ?>
                                    <td><?= str_pad($frequencia["totalAulas"], 6, "0", STR_PAD_LEFT); ?></td>
                                    <?php } else { ?> 
                                    <td>Não Houveram Aulas Ainda</td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th>Presenças</th>
                                    <?php if($frequencia["totalAulas"] > 0){ ?>
                                    <td>
                                        <a href="<?= base_url("index.php/aluno/visualizarPresencas/$dadosAluno->codAluno");?>" class="hidden-print">
                                            <?= str_pad($frequencia["Presente"], 6, "0", STR_PAD_LEFT); ?>
                                        </a>
                                    </td>
                                    <?php } else { ?> 
                                    <td>Não Houveram Aulas Ainda</td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th>Ausencias:</th>
                                    <?php if($frequencia["totalAulas"] > 0){ ?>
                                    <td><?= str_pad($frequencia["Ausente"], 6, "0", STR_PAD_LEFT); ?></td>
                                    <?php } else { ?> 
                                    <td>Não Houveram Aulas Ainda</td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th>Aproveitamento:</th>
                                    <?php if($frequencia["totalAulas"] > 0){ ?>
                                    <td><?= number_format($frequencia["Presente"] * 100 / $frequencia["totalAulas"], 2, ",", "."); ?>% </td>
                                    <?php } else { ?> 
                                    <td>Não Houveram Aulas Ainda</td>
                                    <?php } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
                
            </div>
            <!-- /.row -->
            
            <?php }else { ?>
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <p class="lead">Dados sobre Frequencia</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width:50%">Total de Aulas:</th>
                                    <?php if($frequencia["totalAulas"] > 0){ ?>
                                    <td><?= str_pad($frequencia["totalAulas"], 6, "0", STR_PAD_LEFT); ?></td>
                                    <?php } else { ?> 
                                    <td>Não Houveram Aulas Ainda</td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th>Presenças</th>
                                    <?php if($frequencia["totalAulas"] > 0){ ?>
                                    <td>
                                        <a href="<?= base_url("index.php/aluno/visualizarPresencas/$dadosAluno->codAluno");?>" class="hidden-print">
                                            <?= str_pad($frequencia["Presente"], 6, "0", STR_PAD_LEFT); ?>
                                        </a>
                                    </td>
                                    <?php } else { ?> 
                                    <td>Não Houveram Aulas Ainda</td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th>Ausencias:</th>
                                    <?php if($frequencia["totalAulas"] > 0){ ?>
                                    <td><?= str_pad($frequencia["Ausente"], 6, "0", STR_PAD_LEFT); ?></td>
                                    <?php } else { ?> 
                                    <td>Não Houveram Aulas Ainda</td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th>Aproveitamento:</th>
                                    <?php if($frequencia["totalAulas"] > 0){ ?>
                                    <td><?= number_format($frequencia["Presente"] * 100 / $frequencia["totalAulas"], 2, ",", "."); ?>% </td>
                                    <?php } else { ?> 
                                    <td>Não Houveram Aulas Ainda</td>
                                    <?php } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>
            
            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <!--button  class="btn btn-default"><i class="fa fa-print"></i> Print</a-->
                    <!--button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button-->
                    <button type="button" onClick="window.print();" class="btn btn-primary pull-right" style="margin-right: 5px;">
                        <i class="fa fa-print"></i> Imprimir
                    </button>
                </div>
            </div>
        </section>
    </section>
</div>

<style>
    .clsData{
        margin-left: 8px;
        font-size: 15px;
        color: black;
        font-family: monospace;
    }

</style>
