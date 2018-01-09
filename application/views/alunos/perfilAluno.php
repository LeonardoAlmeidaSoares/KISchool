<?php

function getStatusPagto($cod, $dataVencimento) {
    $ret = "";
    switch ($cod) {
        case -1:
            $ret = "<span class='label label-danger'>Cancelado</span>";
            break;
        case 0:
            if (date("Y-m-d") == $dataVencimento) {
                $ret = "<span class='label bg-navy'>Vencendo Hoje</span>";
            } else {
                if (date("Y-m-d") < $dataVencimento) {
                    $ret = "<span class='label label-warning'>A Vencer</span>";
                } else {
                    $ret = "<span class='label bg-purple'>Atrasado</span>";
                }
            }
            break;
        case 1:
            $ret = "<span class='label label-success'>Quitado</span>";
            break;
    }
    return $ret;
}

function getStatus($cod) {
    $ret = "";
    switch ($cod) {
        case STATUS_ALUNO_CANCELADO: $ret = "<span class='label label-danger'>CENCELADO</span>";
            break;
        case STATUS_ALUNO_NORMAL: $ret = "<span class='label label-success'>NORMAL</span>";
            break;
        case STATUS_ALUNO_FALTOSO: $ret = "<span class='label label-warning'>FALTOSO</span>";
            break;
        case STATUS_ALUNO_CANCELAMENTO_PENDENTE: $ret = "<span class='label label-info'>CANCELAMENTO PENDENTE</span>";
            break;
    }
    return $ret;
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Perfil do Aluno
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Alunos</a></li>
            <li class="active">Perfil de Aluno</li>
        </ol>
    </section>
    <input type='hidden' id='codAluno' value='<?= $dadosAluno->codAluno; ?>' />
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <h3 class="profile-username text-center"><?= $dadosAluno->nome; ?></h3>

                        <p class="text-muted text-center"><?= $dadosCurso->nome; ?></p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Aulas</b> 
                                <a class="pull-right"><?= str_pad($dadosChamada->Aulas, 4, "0", STR_PAD_LEFT); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Presenças</b> <a class="pull-right"><?= str_pad($dadosChamada->Presencas, 4, "0", STR_PAD_LEFT); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Ausencias</b> <a class="pull-right"><?= str_pad($dadosChamada->Ausencias, 4, "0", STR_PAD_LEFT); ?></a>
                            </li>

                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> Telefone</strong>

                        <p class="text-muted">
                            <?= $dadosAluno->telefone; ?>
                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Endereço</strong>

                        <?php
                        $endereco = $dadosAluno->logradouro;
                        $endereco .= (strlen($dadosAluno->complemento) == 0) ? " - " : "/$dadosAluno->complemento - ";
                        $endereco .= $dadosAluno->bairro;
                        ?>
                        <p class="text-muted"><?= $endereco; ?></p>

                        <hr>

                        <strong><i class="fa fa-pencil margin-r-5"></i> Status</strong>

                        <p><?= getStatus($dadosAluno->status); ?></p>

                        <hr>
                        <?php if ($dadosObs->num_rows() > 0) { ?>
                            <strong><i class="fa fa-file-text-o margin-r-5"></i> Última Observação</strong>
                            <br>
                            <p><?= $dadosObs->row(0)->texto; ?></p>
                        <?php } ?>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#div_atividades" data-toggle="tab" >Atividades</a>
                        </li>
                        <!--li><a href="#div_academico" data-toggle="tab">Acadêmico</a></li-->
                        <li>
                            <a href="#div_financeiro" data-toggle="tab">Financeiro</a>
                        </li>
                        <li>
                            <a href="#div_acoes" data-toggle="tab">Ações</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="div_atividades">
                            <div class="row">
                                <div class="col-lg-7">
                                    <?php foreach ($vidaAcademica->result() as $item) { ?>
                                        <?php $val = (($item->DiasPercorridos * 100) / $item->TotalDias); ?>
                                        <p>
                                            <code><?= $item->descricao; ?></code>
                                            <?php if ($item->status > COD_STATUS_COMPROVANTE_CRIADO) { ?>
                                                <a class="pull-right" style="color: #000;" href="<?= base_url("index.php/aluno/Certificado/$dadosAluno->codAluno/$item->codItem"); ?>">
                                                    <span class="fa fa-mortar-board"></span>
                                                </a>
                                            <?php } ?>
                                        </p>
                                        <a href="#" codModulo="<?= $item->codItem; ?>">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" 
                                                     aria-valuenow="<?= $val; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $val; ?>%">
                                                    <span class="sr-only"><?= $val; ?>% Completo (sucesso)</span>
                                                </div>
                                            </div>
                                        </a>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-5">
                                    <div id="div_grafico_frequencia"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="div_financeiro">
                            <div class='content'>
                                <table class="table table-bordered table-condensed table-hover table-responsive table-striped">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Descrição</th>
                                            <th>Valor</th>
                                            <th>Vencimento</th>
                                            <th>Data de Pagamento</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($boletos->result() as $item) { ?>
                                            <tr>
                                                <th><?= str_pad($item->codPagamento, 8, "0", STR_PAD_LEFT); ?></th>
                                                <td><?= $item->descricao; ?></td>
                                                <td>R$ <?= number_format($item->valor, 2, ",", "."); ?></td>
                                                <td><?= date("d/m/Y", strtotime($item->dataVencimento)); ?></td>
                                                <td><?= $item->dataPagto; ?></td>
                                                <td><?= getStatusPagto($item->status, $item->dataVencimento); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="div_acoes">
                            <div class='content'>
                                
                                <div class="col-xs-8">
                                    <fieldset>
                                        <legend>Documentação</legend>
                                        
                                        <div class="col-xs-3">
                                            <a target="_blank" href="<?= base_url("index.php/documentacao/declaracao/$dadosContrato->codContrato");?>" style="text-align: center;">
                                                <figure>
                                                    <img src="<?= base_url("assets/images/reg.png");?>" alt="" style="width:100px;" />
                                                </figure>
                                                <figcaption>
                                                    <h4>Declaração</h4>
                                                </figcaption>
                                            </a>
                                        </div>
                                        
                                        <div class="col-xs-3">
                                            <a target="_blank" href="<?= base_url("index.php/documentacao/rescisao/$dadosContrato->codContrato");?>" style="text-align: center;">
                                                <figure>
                                                    <img src="<?= base_url("assets/images/reg.png");?>" alt="" style="width:100px;" />
                                                </figure>
                                                <figcaption>
                                                    <h4>Rescisão</h4>
                                                </figcaption>
                                            </a>
                                        </div>
                                        
                                        <div class="col-xs-3">
                                            <a target="_blank" href="<?= base_url("index.php/documentacao/trancamento/$dadosContrato->codContrato");?>" style="text-align: center;">
                                                <figure>
                                                    <img src="<?= base_url("assets/images/reg.png");?>" alt="" style="width:100px;" />
                                                </figure>
                                                <figcaption>
                                                    <h4>Trancamento</h4>
                                                </figcaption>
                                            </a>
                                        </div>
                                        
                                        <div class="col-xs-3">
                                            <a target="_blank" href="<?= base_url("index.php/documentacao/acordo/$dadosContrato->codContrato");?>" style="text-align: center;">
                                                <figure>
                                                    <img src="<?= base_url("assets/images/reg.png");?>" alt="" style="width:100px;" />
                                                </figure>
                                                <figcaption>
                                                    <h4>Acordo</h4>
                                                </figcaption>
                                            </a>
                                        </div>
                                        
                                    </fieldset>
                                </div>
                                
                                <div class="col-xs-4">
                                    <fieldset>
                                        <legend>Ações</legend>
                                        <div class="col-xs-6">
                                            <button type="button" class="btn btn-block btn-danger btn-lg" id='btn_cancelar_contrato'>
                                                Cancelar <br /> contrato
                                            </button>
                                        </div>
                                        
                                        <div class="col-xs-6">
                                            <button type="button" class="btn btn-block btn-info btn-lg">
                                                Ainda sem <br /> Ação
                                            </button>
                                        </div>
                                        
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
</div>
<!-- /.row -->
<input type='hidden' id='perm_diretor' value='<?= $_SESSION["perm_data"]->perm_direcao; ?>' />
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    data = [];
    names = [];
    dataP = [];
    dataTotal = [];

<?php foreach ($graficoPresencaAluno->result() as $item) { ?>
        dataP.push(<?= $item->Presencas; ?>);
        dataTotal.push(<?= $item->TotalAulas - $item->Presencas; ?>);
        names.push("<?= $item->descricao; ?>");
<?php } ?>
    data.push({name: 'Presencas', data: dataP});
    data.push({name: 'Ausencias', data: dataTotal});
</script>

<script src="https://code.highcharts.com/highcharts.js" type="text/javascript"></script>
<link href="<?= base_url("assets/plugins/datatables/jquery.dataTables.min.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/plugins/datatables/jquery.dataTables.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/perfilAluno.js"); ?>" type="text/javascript"></script>