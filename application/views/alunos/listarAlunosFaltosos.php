<?php function getStatus($cod){
    $ret = "";
    
    switch($cod){
        case STATUS_ALUNO_ABANDONOU: 
            $ret = "<span class='bg-maroon-active' style='padding: 5px;'>ALUNO ABANDONOU</span>";
            break;
        case STATUS_ALUNO_CANCELAMENTO_PENDENTE:
            $ret = "<span class='bg-aqua' style='padding: 5px;'>CANCELAMENTO PENDENTE</span>";
            break;
        case STATUS_ALUNO_FALTOSO:
            $ret = "<span class='bg-teal' style='padding: 5px;'>ALUNO FALTOSO</span>";
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
            Alunos
            <small>Listagem de Alunos</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i>Alunos
                </a>
            </li>
            <li class="active">Listagem</li>
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
                            <th>Email</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista->result() as $item) { ?>
                            <tr>
                                <td><?= str_pad($item->codAluno, 6, "0", STR_PAD_LEFT); ?></td>
                                <td><?= $item->nome; ?></td>
                                <td><?= $item->telefone; ?></td>
                                <td><?= $item->email; ?></td>
                                <td><?= getStatus($item->status); ?></td>
                                <td>
                                    <a href="<?= base_url("index.php/aluno/observacao/$item->codAluno");?>" title="Inserir Observação sobre <?= $item->nome; ?>" style="text-decoration: none; color: #000;" >
                                        <span class="glyphicon glyphicon-comment" cod="<?= $item->codAluno;?>">
                                    </a>
                                    <span class="glyphicon glyphicon-align-justify spnLiberarVaga" title="Liberar a Vaga de <?= $item->nome;?>" codAluno="<?= $item->codAluno;?>" style="cursor: pointer;"></span> 
                                    <span class="glyphicon glyphicon-map-marker spnResolve" title="Finalizar Situação de <?= $item->nome;?>" codAluno="<?= $item->codAluno;?>" style="cursor: pointer;"></span>
                                    <span class="fa fa-mail-reply spnRetornar" title="Retornar com a vaga de <?=$item->nome;?> na turma" style="cursor: pointer;" codAluno="<?=$item->codAluno;?>">
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<link href="<?= base_url("assets/plugins/datatables/jquery.dataTables.min.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/plugins/datatables/jquery.dataTables.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/listagemFaltosos.js"); ?>" type="text/javascript"></script>
