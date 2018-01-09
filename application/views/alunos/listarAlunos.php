<?php 
    $checarFinanceiro = ($_SESSION["perm_data"]->perm_pagamento >= 1);
    $cancelarAluno = ($_SESSION["perm_data"]->perm_aluno == 2);
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
                            <?php if($cancelarAluno){ ?><th>Histórico</th><?php } ?>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista->result() as $item) { ?>
                            <tr>
                                <td><?= str_pad($item->codAluno, 6, "0", STR_PAD_LEFT); ?></td>
                                <td><?= $item->nome; ?></td>
                                <td><?= $item->telefone; ?></td>
                                
                                <?php if($cancelarAluno){ ?>
                                <td>
                                    <a href="<?= base_url("index.php/aluno/historico/$item->codAluno");?>" style="text-decoration: none;color: #000;" title="Histórico"> 
                                        <span class="label label-success" cod="<?= $item->codAluno;?>">HISTÓRICO</span>
                                    </a>
                                </td>
                                <?php } ?>
                                
                                <td>
                                    <a href="<?= base_url("index.php/aluno/perfilAluno/$item->codAluno");?>" style="text-decoration: none;color: #000;" title="Perfil de Aluno" > 
                                        <span class="glyphicon glyphicon-eye-open" cod="<?= $item->codAluno;?>"></span>
                                    </a>
                                                                 
                                    <?php if($cancelarAluno){ ?>
                                    <a href="<?= base_url("index.php/aluno/perfilAluno/$item->codAluno#div_acoes");?>" style="text-decoration: none;color: #000;" title="Cancelar Contrato"> 
                                        <span class="glyphicon glyphicon-remove" cod="<?= $item->codAluno;?>"></span>
                                    </a>
                                    <?php } ?>
                                    
                                    <?php if($checarFinanceiro){ ?>
                                        <a href="<?= base_url("index.php/aluno/visualizarPendencias/$item->codAluno");?>" style="text-decoration: none;color: #000;" title="Checar Financeiro"> 
                                            <span class="glyphicon glyphicon glyphicon-usd" cod="<?= $item->codAluno;?>"></span>
                                        </a>
                                    <?php } ?>
                                    
                                    <a href="<?= base_url("index.php/aluno/transferencia/$item->codAluno");?>" style="text-decoration: none; color: #000;" title="Transferencia">
                                        <span class="glyphicon glyphicon-transfer" cod="<?= $item->codAluno;?>">
                                    </a>
                                    
                                    <a href="<?= base_url("index.php/aluno/observacao/$item->codAluno");?>" style="text-decoration: none; color: #000;" title="Observações">
                                        <span class="glyphicon glyphicon-comment" cod="<?= $item->codAluno;?>">
                                    </a>
                                    
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php if($_SESSION["perm_data"]->perm_aluno == 2){ ?>
            
            <div class="pull-right">
                <a href="<?= base_url("index.php/aluno/novo"); ?>" class="btn btn-success">
                    <i class="fa fa-plus"></i>  Novo
                </a>
            </div>
            
            <?php } ?>
            </div>
            
            <br><br>
            
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<link href="<?= base_url("assets/plugins/datatables/jquery.dataTables.min.css"); ?>" rel="stylesheet" type="text/css"/>
<script src="<?= base_url("assets/plugins/datatables/jquery.dataTables.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/paginas/listagemCurso.js"); ?>" type="text/javascript"></script>

<?php if(isset($_SESSION["msg_err"])){ ?>
<script>
    $(function(){
        swal("Então...", "<?= $_SESSION["msg_err"];?>", "error");
    });
</script>
<?php $_SESSION["msg_err"] = NULL;} ?>

<?php if(isset($_SESSION["msg_ok"])){ ?>
<script>
    $(function(){
        swal("Parabéns", "<?= $_SESSION["msg_ok"];?>", "success");
    });
</script>
<?php $_SESSION["msg_ok"] = NULL;} ?>
