<?php

function getIdade($data) {
    $ano = date("Y");
    $nasc = intval(substr($data, 0,4));
    return $ano - $nasc;
}
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Alunos
            <small>Listagem de Aniversariantes</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i>Aniversariantes
                </a>
            </li>
            <li class="active">Todos os Aniversariantes</li>
        </ol>
    </section>
    <hr />
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="col-xs-12">
            <div class="row">
                <table id="table" class="table table-condensed table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Função</th>
                            <th>Idade</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista->result() as $item) { ?>
                            <tr>
                                <td><?= str_pad($item->Codigo, 6, "0", STR_PAD_LEFT); ?></td>
                                <td><?= $item->nome; ?></td>
                                <td><?= $item->telefone; ?></td>
                                <td><?= $item->Funcao;?></td>
                                <td><?= getIdade($item->nascimento); ?></td>
                                <td><span class="glyphicon glyphicon-send" mail="<?= $item->email;?>" style="cursor: pointer;"></span></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <br><br>
            <div class="pull-right">
                <a href="<?= base_url("index.php/aluno/novo"); ?>" class="btn btn-success">NOVO</a>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<link href="<?= base_url("assets/plugins/datatables/jquery.dataTables.min.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/plugins/datatables/jquery.dataTables.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/listagemAniversariantes.js"); ?>" type="text/javascript"></script>
